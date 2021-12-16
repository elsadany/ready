<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use Illuminate\Support\Facades\Validator;
use App\Models\HomePageProperty;
use App\Models\GeneralTag;
use App\Models\Branch;
use App\Http\Resources\GeneralTagResource;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Models\Shop;
use App\Models\ShopsTag;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ShopResource;
use App\Models\Location;
class HomePageController extends Controller {

    function index(Request $request) {
        $validator = Validator::make($request->all(), [
                    'lang_id' => 'required|int',
                    'location_id' => 'sometimes|int',
                    'city' => 'sometimes|string',
        ]);
        if ($validator->fails() || ($request->location_id == null & $request->city = null)) {
            return response()->json([
                        'status' => false,
                        'meesage' => 'please choose your location & language',
                        'errors' => $validator->errors()
            ]);
        }
        $homepage = HomePage::first();
        $key = 0;
        if ($request->location_id == null) {
            $location = Location::where('city', '=', $request->city)->first();
            if (!is_object($location))
                return response()->json(['status' => false, 'message' => trans('messages.we_does_not_deliver_here')]);
            else
                $location_id = $location->id;
        }else {
            $location_id = $request->location_id;
        }
        $shops_ids = Branch::where('location_id', $request->location_id)->pluck('shop_id')->toArray();
        if (count($shops_ids) == 0) {
            return response()->json(['status' => false, 'message' => trans('messages.no_shops_avliable')]);
        }
        $data = [];
        foreach ($homepage->properties as $key => $property) {
            if ($property->type == 0) {
                $category = Category::find($property->category_id);
                $cache_key = md5('shops/category/' . $category->id . '/' . json_encode($request->all()));
                if (Cache::has($cache_key)) {
                    if (count(Cache::get($cache_key))) {
                        $data[$key] = $category->toArray();
                        $data[$key]['type'] = 0;

                        $data[$key]['shops'] = ShopResource::collection(Cache::get($cache_key));
                    }
                } else {
                    $shops = Shop::join('users', 'users.id', '=', 'shops.user_id')
                            ->join('shop_langs', 'shops.id', '=', 'shop_langs.shop_id')
                            ->where('shops.category_id', $category->id)
                            ->where('shop_langs.lang_id', $request->lang_id)
                            ->whereIn('shops.id', $shops_ids)
                            ->where('users.status', 1)
                            ->get();
                    if (count($shops)) {

                        $data[$key] = $category->toArray();
                        $data[$key]['type'] = 0;
                        Cache::put($cache_key, $shops, 60 * 60);
                        $data[$key]['shops'] = ShopResource::collection($shops);
                    }
                }
              
            } elseif ($property->type == 1) {
                $filter = GeneralTag::find($property->tag_id);
                $cache_key = md5('shops/tag/' . $filter->id . '/' . json_encode($request->all()));
                $shop_ids = ShopsTag::whereIn('shop_id', $shops_ids)->where('general_tag_id', $filter->id)->pluck('shop_id')->toArray();
                if (count($shop_ids) > 0) {
                    if (Cache::has($cache_key)) {
                        if (count(Cache::get($cache_key))) {
                            $data[$key] = $filter->toArray();
                            $data[$key]['type'] = 1;
                            $data[$key]['shops'] = ShopResource::collection(Cache::get($cache_key));
                        }
                    } else {

                        $shops = Shop::join('users', 'users.id', '=', 'shops.user_id')
                                ->join('shop_langs', 'shops.id', '=', 'shop_langs.shop_id')
                                ->where('shop_langs.lang_id', $request->lang_id)
                                ->whereIn('shops.id', $shop_ids)
                                ->where('users.status', 1)
                                ->get();

                        if (count($shops)) {
                            $data[$key] =$filter->toArray();
                            $data[$key]['type'] = 1;
                            Cache::put($cache_key, $shops, 60 * 60);
                            $data[$key]['shops'] = ShopResource::collection($shops);
                        }
                    }
                }
               
                if ($homepage->show_recent == 1) {
                    $key = $key + 1;
                    $data[$key] = ['name'=>trans('home-page.recent')];
                    $cache_key = md5('shops/recent/' . json_encode($request->all()));
                    if (Cache::has($cache_key)) {
                        $data[$key]['shops'] = ShopResource::collection(Cache::get($cache_key));
                    } else {
                        $shops = Shop::join('users', 'users.id', '=', 'shops.user_id')
                                ->join('shop_langs', 'shops.id', '=', 'shop_langs.shop_id')
                                ->where('shop_langs.lang_id', $request->lang_id)
                                ->whereIn('shops.id', $shops_ids)
                                ->where('users.status', 1)
                                ->OrderBy('shops.id', 'desc')
                                ->get();
//                        Cache::put($cache_key, $shops, 60 * 60);
                       
                        $data[$key]['shops'] = ShopResource::collection($shops);
                    }
                }
                if ($homepage->show_nearest == 1) {
                    $key = $key + 1;
                    $data[$key] = ['name'=>trans('home-page.nearest')];
                    $cache_key = md5('shops/nearest/' . json_encode($request->all()));
                    if (Cache::has($cache_key)) {
                        $data[$key]['shops'] = ShopResource::collection(Cache::get($cache_key));
                    } else {
                        $shops = Shop::join('users', 'users.id', '=', 'shops.user_id')
                                ->join('shop_langs', 'shops.id', '=', 'shop_langs.shop_id')
                                ->where('shop_langs.lang_id', $request->lang_id)
                                ->whereIn('shops.id', $shops_ids)
                                ->where('users.status', 1)
                                ->OrderBy('shops.id', 'desc')
                                ->get();
//                        Cache::put($cache_key, $shops, 60 * 60);
                        $data[$key]['shops'] = ShopResource::collection($shops);
                    }
                }
            }
        }
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => $data
        ]);
    }
    function getMapData(Request $request){
         $validator = Validator::make($request->all(), [
                    'lat'=>'required',
             'lng'=>'required'
        ]);
        if ($validator->fails() || ($request->location_id == null & $request->city = null)) {
            return response()->json([
                        'status' => false,
                        'meesage' => 'Not Found',
                        'errors' => $validator->errors()
            ]);
        }
            $data= $this->getCityFromLatLng($request->lat,$request->lng);
            if(!$data){
                 return response()->json([
                        'status' => false,
                        'meesage' => 'please choose your location & language',
                        'errors' => []
            ]);   
            }
            $locationarr=null;
             $location=Location::where($data)->first();
             if(is_object($location)){
                 
                 $exist=1;
                 $locationarr=$location->toArray();
             }
             else{
             $exist=0;}
              return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => $locationarr,
                  'exist'=>$exist
        ]);
            
    }
    function getCityFromLatLng($lat,$lng){
        
        $endpoint = "https://maps.googleapis.com/maps/api/geocode/json";
        $client = new \GuzzleHttp\Client();
       

        $response = $client->request('GET', $endpoint, ['query' => [
            'latlng' => $lat.','.$lng, 
            'sensor' => true,
            'key' => 'AIzaSyAylzC-TDTEVjgHp5EI1ofRN5Jhdrekrhg',
        ]]);


            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);
         
   
            if(key_exists('results', $content) && count($content['results'])>=3){
             
                $last_index=count($content['results'])-2;
                $country=$content['results'][$last_index]['formatted_address'];
                $countryarr= explode(',', $country);
               
                $address_arr=$content['results'][1]['address_components'];
//                dd($address_arr);
                $result['country']=$address_arr[count($address_arr)-1]['long_name'];
                $governorate= explode(',', $content['results'][count($content['results'])-2]['formatted_address']);
                $result['gover']=$address_arr[count($address_arr)-2]['long_name'];
//                dd($content['results']);
                $city='';
               if(count($address_arr)>2)
               { 
                   $city=$address_arr[count($address_arr)-3]['long_name'];
        
               }
//                               dd($result);

                
                $result['city']=$city;
          
                return $result;
            
            }

        return false;
    }
    function about(Request $request){
        $about=[];
        $about['content']='<p>text</p>';
        return response()->json(['status'=>true,'data'=>$about]);
    }
}
