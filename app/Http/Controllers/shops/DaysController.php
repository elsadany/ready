<?php

namespace App\Http\Controllers\Shops;

use App\Models\Offer;
use App\Models\OfferBranches;
use App\Models\OfferMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class DaysController extends Controller {

    function index(Request $request) {
        $shop_id = auth()->guard('shop')->user()->id;
  
        return view('shops.days.index');
    }

    function save(Request $request) {
        $shop_id = auth()->guard('shop')->user()->id;
        \App\Models\ShopDays::where('shop_id',$shop_id)->delete();
        for($x=0;$x<7;$x++){
            $day=new \App\Models\ShopDays();
            $day->shop_id=$shop_id;
            $day->day=$x;
            $day->is_open=$request->get('days')['is_open'][$x];
            if(array_key_exists('open_at', $request->days)&&array_key_exists($x, $request->days['open_at']))
                    $day->open_at=$request->get('days')['open_at'][$x];
            if(array_key_exists('close_at', $request->days)&&array_key_exists($x, $request->days['close_at']))
                    $day->close_at=$request->get('days')['close_at'][$x];
            $day->save();
        }
            return redirect()->back()->with('success','Updated Successfully');
    }

  
}
