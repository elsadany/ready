<?php

namespace App\Http\Controllers\apis;

use App\Models\Shop;
use App\Models\Branch;
use App\Models\Location;
use App\Models\ShopsCuisine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\apis\MenuAPI;
use Illuminate\Support\Facades\Validator;

class ShopsAPI extends Controller
{
    function get(Request $request){
        $validator= Validator::make($request->all(), [
            'lang_id'=>'required|int',
            'location_id'=>'sometimes|int',
            'city'=>'sometimes|string',
            'search.category_id'=>'int',
            'search.cuisine_id'=>'array',
            'search.tag_id'=>'array',
        ]);


        $cache_key=md5('shop/get/'.json_encode($request->all()));
        if(false && Cache::has($cache_key)){
            
            return response()->json([
                'status'=>true,
                'message'=>trans('messages.success'),
                'data'=>ShopResource::collection(Cache::get($cache_key))
            ]);
        }

        if($validator->fails() || ($request->location_id==null & $request->city=null)){
            return response()->json([
                'status'=>false,
                'meesage'=>'please choose your location & language',
                'errors'=>$validator->errors()
            ]);
        }

        // init shops object with lang and validate user
        $shops=Shop::join('users','users.id','=','shops.user_id')
        ->join('shop_langs','shops.id','=','shop_langs.shop_id')
        ->where('shop_langs.lang_id',$request->lang_id)
        ->where('users.status',1);


        // validate and get city_id
        if($request->location_id==null){
            $location=Location::where('city','=',$request->city)->first();
            if(!is_object($location))
                return response()->json(['status'=>false,'message'=>trans('messages.we_does_not_deliver_here')]);
            else
                $location_id=$location->id;
        }else{
            $location_id=$request->location_id;
        }


        // get branches in current location
        $shops_ids=Branch::where('location_id',$request->location_id)->groupBy('shop_id')->pluck('shop_id')->toArray();
        if(count($shops_ids)==0){
          
            return response()->json(['status'=>false,'message'=>trans('messages.no_shops_avliable')]);
        }else{
            $shops=$shops->whereIn('shops.id',$shops_ids);
        }

        if($request->search)
            $shops=$this->search($request,$shops);

        $shops=$shops->select('shops.*','shop_langs.name');
        if($request->order&&$request->order!='')
            $shops= $this->order ($request->order, $shops);
               $shops=$shops->get();
        
        Cache::put($cache_key,$shops, 60*60);
        

        return response()->json([
            'status'=>true,
            'message'=>trans('messages.success'),
            'data'=>ShopResource::collection($shops)
        ]);
    }

    function order($order,$shops){
  
           
            
            switch ($order) {
                case 'min_order':
                    $shops=$shops->orderBy('shops.min_order','asc');
                    break;
                case 'fast_delivery ':
                
                    $shops=$shops->orderBy('shops.dlivary_rime','asc');
                   
                    break;                
                case 'atoz':
             
                    $shops=$shops->orderBy('shops.name','asc');
                    break;                
                case 'rate':
             
                    $shops=$shops->orderBy('shops.rate','desc');
                    break;                
            } //end switch
        
        return $shops;
    }

    function search($request,$shops){
        foreach($request->search as $key=>$value){
           
            
            switch ($key) {
                case 'category_id':
                    $shops=$shops->where('category_id',$value);
                    break;
                case 'cuisine_id':
                    $shops_ids=ShopsCuisine::whereIn('cuisine_id',$value)->pluck('shop_id')->toArray();
                    $shops=$shops->whereIn('shops.id',$shops_ids);
                   
                    break;                
                case 'tag_id':
                    $shops_ids= \App\Models\ShopsTag::whereIn('general_tag_id',$value)->pluck('shop_id')->toArray();
                    $shops=$shops->whereIn('shops.id',$shops_ids);
                    break;                
            } //end switch
        } // endforeach
        return $shops;
    }


    function show(Request $request,$id){
        $validator= Validator::make($request->all(), [
            'lang_id'=>'required|int'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'meesage'=>'please choose your location & language',
                'errors'=>$validator->errors()
            ]);
        }
        $shop=Shop::join('users','users.id','=','shops.user_id')
        ->join('shop_langs','shops.id','=','shop_langs.shop_id')
        ->where('shop_langs.lang_id',$request->lang_id)
        ->where('users.status',1)
        ->where('shops.id',$id)
        ->select('shops.*','shop_langs.name')->first();
        if(!is_object($shop)){
            return response()->json(['status'=>false,'errors'=>['not Found']]);
        }
        $data['shop']=new ShopResource($shop);
        $data['menu']=(new MenuAPI)->get($request,$id);
        return response()->json([
            'status'=>true,
            'message'=>'success',
            'data'=>$data
            ]);
    }

}
