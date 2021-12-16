<?php

namespace App\Http\Controllers\backend;

use App\Models\Review;
use App\Models\ReviewBranches;
use App\Models\ReviewMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class ReviewsController extends Controller {

    function index(Request $request, $shop_id = null) {

        $data['result'] = new Review;
        $data['shop_id']=$shop_id;
        if ($shop_id!=null)
            $data['result'] = $data['result']->where('shop_id', $shop_id);
        $data['result'] = $data['result']->orderBy('id', 'desc')->paginate(30);
        $data['shops'] = \App\Models\Shop::all();
        return view('backend.reviews.index', $data);
    }

   function delete(Request $request, Review $review) {
       
        $review->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح']);
    }

}
