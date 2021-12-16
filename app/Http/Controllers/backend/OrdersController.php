<?php

namespace App\Http\Controllers\backend;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Location;
use App\Models\BranchLang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Elsayednofal\BackendLanguages\Models\Languages;

class OrdersController extends Controller {

    function index(Request $request, $shop_id = null) {
        $orders = new Order;
        if ($shop_id!=null)
            $orders = $orders->where('shop_id', $shop_id);
        
        $orders = $orders->paginate(25);
        $shops = Shop::all();
        return view('backend.orders.index', [
            'orders' => $orders,
            'shops' => $shops,
            'shop_id' => $shop_id
        ]);
    }



    function delete(Order $order) {
        $order->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح']);
    }

}
