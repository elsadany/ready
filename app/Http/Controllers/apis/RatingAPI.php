<?php

namespace App\Http\Controllers\apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class RatingAPI extends Controller
{
    function add(Request $request){
        $rules=
                ['shop_id'=>'required|exists:shops,id',
                    'rate'=>'required|integer|min:1|max:5'
                    ];
         $validator = Validator::make($request->all(),$rules);
        if ($validator->fails() ) {
            return response()->json([
                        'status' => false,
                        'meesage' => 'please choose your location & language',
                        'errors' => $validator->errors()
            ]);
        }
        $rating=new \App\Models\Review();
        $rating->rate=$request->rate;
        $rating->shop_id=$request->shop_id;
        $rating->user_id=$request->user()->id;
        $rating->comment=$request->comment;
        $rating->save();
        $shop= \App\Models\Shop::find($request->shop_id);
        $shop->rate= \App\Models\Review::where('shop_id',$shop->id)->sum('rate')/\App\Models\Review::where('shop_id',$shop->id)->count();
        $shop->save();
          return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => []
        ]);
    }
}
