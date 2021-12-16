<?php

namespace App\Http\Controllers\apis;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Events\CreateOrderEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CartApi extends Controller {

    function Add(Request $request) {
        $v = Validator::make($request->all(), [
                    'menu_id' => 'required|int|exists:menus,id',
                    'location_id' => 'required|int|exists:branches,location_id',
                    'choose_id' => 'int',
                    'add_ids' => 'array',
                    'session_id' => 'string',
                    'notes' => 'string',
                    'number' => 'required|int|min:1'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $v->errors()]);

        $menu = Menu::find($request->menu_id);
        $branch = Branch::where('location_id', $request->location_id)->where('shop_id', $menu->shop->id)->first();
        if($branch->busy==1)
            return response()->json(['status' => false, 'message' => trans("messages.shop_busy"), 'errors' => []]);
            
        if ($menu->has_chooses && $request->choose_id == '')
            return response()->json(['status' => false, 'message' => trans("messages.must_have_achoose"), 'errors' => []]);


        if (auth()->guard('api')->check()) {
        
            $cart = Cart::where('user_id' , auth()->guard('api')->user()->id)->first();
            if(!is_object($cart))
                $cart=new \App\Models\cart ();
            $cart->user_id = auth()->guard('api')->user()->id;
        } else if ($request->session_id != '') {
            $cart = Cart::firstOrNew(['session_id' => $request->session_id]);
            $cart->session_id = $request->session_id;
        } else {
            $cart = new Cart;
            $cart->session_id = $this->generateSessionToken();
        }


        $cart->shop_id = $menu->shop->id;
        $branch = Branch::where('location_id', $request->location_id)->where('shop_id', $cart->shop_id)->first();
        $cart->branch_id = $branch->id;
        $cart->items_count = $cart->items_count + 1;
        $cart->total_price = $cart->total_price + ($menu->price * $request->number);
        $cart->delivery_fee = ($menu->shop&&$menu->shop->delivery_fee)?$menu->shop->delivery_fee:0;
        $cart->save();

        $price = $menu->price;
        if ($request->choose_id != '') {
            if ($menu->chooses()->where('id', $request->choose_id)->first())
                $price += $menu->chooses()->where('id', $request->choose_id)->first()->price;
        }
        if ($request->add_ids != '')
            $price += $menu->adds()->whereIn('id', $request->add_ids)->sum('price');
        $price *= $request->number;


        $cart_item = CartItem::where([
                    'cart_id' => $cart->id,
                    'menu_id' => $menu->id,
                    'choose_id' => $request->choose_id,
                    'add_ids' => $request->add_ids,
                ])->first();

        if (is_object($cart_item)) {
            $cart_item->number += $request->number;
            $cart_item->price *= $cart_item->number;
            $cart_item->save();
        } else {
            $menu_item = CartItem::create([
                        'cart_id' => $cart->id,
                        'menu_id' => $menu->id,
                        'add_ids' => $request->add_ids,
                        'choose_id' => $request->choose_id,
                        'price' => $price,
                        'number' => $request->number
            ]);
            if ($menu->chooses()->where('id', $request->choose_id)->first())
                $menu_item->choose_id = $request->choose_id;
            $cart->total_price = $this->calculateTotal($cart);
            $cart->save();
        }




        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => new CartResource($cart)
        ]);
    }

    function clear(Request $request) {
        if (!auth()->guard('api')->check()) {
            $v = Validator::make($request->all(), [
                        'session_id' => 'string|exists:cart,session_id',
                        'lang_id' => 'required|int|exists:languages,id'
            ]);
            if ($v->fails())
                return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $v->errors()]);
            $cart = Cart::where('session_id', $request->session_id)->delete();
        }else {
            $cart = auth()->guard('api')->user()->cart()->delete();
        }
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => null
        ]);
    }

    function get(Request $request) {

        if (!auth()->guard('api')->check()) {
            $v = Validator::make($request->all(), [
                        'session_id' => 'string|exists:cart,session_id',
                        'lang_id' => 'required|int|exists:languages,id'
            ]);
            if ($v->fails())
                return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $v->errors()]);
            $cart = Cart::where('session_id', $request->session_id)->first();
        }else {
            $cart = auth()->guard('api')->user()->cart;
        }
        if(!is_object($cart))
                           return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => ['no Cart Found']]);
 
        $total = 0;
        if (is_object($cart)) {
            $total = CartItem::where('cart_id', $cart->id)->sum('price');
            $cart->total_price = $this->calculateTotal($cart);
            $cart->save();
        }
        $discount=0;
        if($request->promocode!=''){
         
          $promo = \App\Models\PromoCode::where('code', $request->promocode)->whereDate('expire_at', '>',\Carbon\Carbon::now())->first();
                if (!is_object($promo))
                    return response()->json(['status' => false, 'message' => trans('messages.not_exist')]);
                $promouser = \App\Models\UsersPromocode::where('promo_code_id', $promo->id)->where('user_id', $cart->user_id)->first();
                if (is_object($promouser))
                    return response()->json(['status' => false, 'message' => trans('messages.used_before')]);
                $discount = $this->calculatePromo($cart->total_price, $promo);
        }
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => new CartResource($cart) ,'discount'=>$discount,
            'total'=>$this->calculateTotal($cart)+$cart->delivery_fee-$discount
           
        ]);
    }

    function removeItem(Request $request) {
        $v = Validator::make($request->all(), [
                    'item_id' => 'required|int|exists:cart_items,id',
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $v->errors()]);

        $item = CartItem::find($request->item_id);
        if (
                (auth()->guard('api')->check() && $item->cart->user_id == auth()->guard('api')->user()->id) ||
                (isset($request->session_id) && $item->cart->session_id == $request->session_id)
        ) {
            $item->delete();
            return response()->json(['status' => true, 'message' => trans('messages.item_removed')]);
        }

        return response()->json(['status' => false, 'message' => trans('messages.access_denied')]);
    }

    function increaseItem(Request $request) {
        $v = Validator::make($request->all(), [
                    'item_id' => 'required|int|exists:cart_items,id',
                    'number' => 'required|int'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);
        $item = CartItem::find($request->item_id);
        if (
                (auth()->guard('api')->check() && $item->cart->user_id == auth()->guard('api')->user()->id) ||
                (isset($request->session_id) && $item->cart->session_id == $request->session_id)
        ) {
            $item->number = $request->number;
            $item->save();
            return response()->json(['status' => true, 'message' => trans('messages.cart_updated')]);
        }
    }

    function checkPromo(Request $request) {
        $v = Validator::make($request->all(), [
                    'promocode' => 'required|exists:promo_codes,code',
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);

        $promocode = \App\Models\PromoCode::where('code', $request->promocode)->whereDate('expire_at', '>', \Carbon\Carbon::now())->first();
        if (!is_object($promocode))
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => ['Promo code not exist']]);
        return response()->json(['status' => true, 'message' => trans('messages.is_exist'), 'date' => $promocode->toArray()]);
    }

    function assignToUser(Request $request) {
        $v = Validator::make($request->all(), [
                    'cart_id' => 'required|int|exists:cart,id',
                    'session_id' => 'required'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);
        $cart = Cart::find($request->cart_id);
        if ($cart->session_id != $request->session_id)
            return response()->json(['status' => false, 'message' => trans('messages.access_denied'), 'errors' => $v->errors()]);
        $cart->user_id = auth()->guard('api')->user()->id;
        $cart->save();
        return response()->json(['status' => true, 'message' => trans('messages.success')]);
    }

    function checkout(Request $request) {
        $v = Validator::make($request->all(), [
                    'cart_id' => 'required|int|exists:cart,id',
            'type'=>'required|min:1|max:3'
                        //'address_id'=>'exists:addresses,id',
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);

        $cart = Cart::find($request->cart_id);
        
        if ($cart->user_id == ''){
            return response()->json(['status' => false, 'message' => trans('messages.login_to_compelete')]);
        }
        DB::beginTransaction();
        try {

            $order = new Order;
            $order->user_id = $cart->user_id;
            $order->time=$request->time;
            $order->type=$request->type;
            $order->shop_id = $cart->shop_id;
            $order->branch_id = $cart->branch_id;
            $order->total = $cart->total_price;
            $order->persons=$request->persons;
            $order->notes=$request->notes;
            $discount = 0;
            if ($request->promocode != '') {
                $promo = \App\Models\PromoCode::where('code', $request->promocode)->whereDate('expire_at','>', \Carbon\Carbon::now())->first();
                if (!is_object($promo))
                    return response()->json(['status' => false, 'message' => trans('messages.not_exist')]);
                $promouser = \App\Models\UsersPromocode::where('promo_code_id', $promo->id)->where('user_id', $cart->user_id)->first();
                if (is_object($promouser))
                    return response()->json(['status' => false, 'message' => trans('messages.used_before')]);
                $discount = $this->calculatePromo($cart->total_price, $promo);
                if ($discount > 0) {
                    $userpromo = new \App\Models\UsersPromocode();
                    $userpromo->user_id = $cart->user_id;
                    $userpromo->promo_code_id = $promo->id;
                    $userpromo->save();
                    $order->promo_id = $promo->id;
                }
            }
            $order->price = $cart->total_price - $discount;
            $order->delevary_fee = Shop::find($cart->shop_id)->delivery_price>0 ? hop::find($cart->shop_id)->delivery_price:0;
            if ($request->address_id) {
                $order->address_id = $request->address_id;
                $order->address_data = Address::find($request->address_id);
                $order->mobile = Address::find($request->address_id)->mobile;
            } else {
                $order->mobile = $request->user()->phone;
            }
            $order->tracking_status = 1;
            $order->payment_type = 0;
            $order->save();

            foreach ($cart->items as $item) {
                $order_item = new OrderDetail;
                $order_item->order_id = $order->id;
                $order_item->menu_id = $item->menu_id;
                $order_item->choose_id = $item->choose_id;
                $order_item->addes_id = $item->add_ids;
                $order_item->price = $item->price;
                $order_item->number = $item->number;
                $order_item->save();
            }

            //$cart->delete();
            event(new CreateOrderEvent($order));
            DB::commit();
            Cart::where('id',$request->cart_id)->delete();
            return response()->json([
                        'status' => true,
                        'message' => trans('messages.success'),
                        'order_id' => $order->id
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    function calculatePromo($total, $promo) {
        if ($promo->min_total > $total)
            return 0;
        if ($promo->type == 0) {
            $discount = $promo->discount * $total / 100;
            if ($discount < $promo->max_discount)
                return $discount;
            else
                return $promo->max_discount;
        }else {
            return $promo->discount;
        }
    }

    function generateSessionToken() {
        return md5(\Request::ip() . \Request::server('HTTP_USER_AGENT') . $this->generateRandomString() . time());
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function calculateTotal($cart) {
     $total=0;
     foreach (CartItem::where('cart_id',$cart->id)->get() as $one){
         $total+=$one->number * $one->price;
     }
           
        return $total;
    }
function clearCart(Request $request){
        Cart::orderBy('id','desc')->delete();
        return true;
    }
}
