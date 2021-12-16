<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FeqsResource;
use App\Http\Resources\FaqsCategoryResource;

class FaqsController extends Controller {

    function categories(Request $request) {
        $categories = \App\Models\FaqsCategory::all();
        $data = FaqsCategoryResource::collection($categories);
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => $data
        ]);
    }

    function index(Request $request) {
          $validator= Validator::make($request->all(), [
            'faqs_category_id'=>'required|int',
           
        ]);
        $faqs = \App\Models\Faq::where('faqs_category_id',$request->faqs_category_id)->get();
        $data = FeqsResource::collection($faqs);
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => $data
        ]);
    }

   
}
