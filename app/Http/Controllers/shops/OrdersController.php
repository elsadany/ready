<?php

namespace App\Http\Controllers\shops;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Location;
use App\Models\BranchLang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Elsayednofal\BackendLanguages\Models\Languages;

class OrdersController extends Controller {

    function index(Request $request) {
        $orders =  Order::where('shop_id',auth()->guard('shop')->user()->id);
       
        $orders = $orders->paginate(25);
        return view('shops.orders.index', [
            'orders' => $orders,
            
        ]);
    }



    function updateStatus(Request $request, Order $order){
        $order->tracking_status=$request->status_id;
        $order->save();
        return redirect()->back()->with('success','updated Successfully');
    }

}
