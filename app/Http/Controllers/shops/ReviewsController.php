<?php

namespace App\Http\Controllers\shops;

use App\Models\Review;
use App\Models\ReviewBranches;
use App\Models\ReviewMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class ReviewsController extends Controller {

    function index(Request $request, $shop_id = null) {

        $data['result'] =Review::where('shop_id',auth()->guard('shop')->user()->id);
      
        $data['result'] = $data['result']->orderBy('id', 'desc')->paginate(30);
        $data['shops'] = \App\Models\Shop::all();
        return view('shops.reviews.index', $data);
    }

  

}
