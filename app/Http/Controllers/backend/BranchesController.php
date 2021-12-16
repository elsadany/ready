<?php

namespace App\Http\Controllers\backend;

use App\Models\Shop;
use App\Models\Branch;
use App\Models\Location;
use App\Models\BranchLang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Elsayednofal\BackendLanguages\Models\Languages;

class BranchesController extends Controller {

    function index(Request $request, $shop_id = null) {
        $branches = new Branch;
        if ($shop_id!=null)
            $branches = $branches->where('shop_id', $shop_id);
        if ($request->has('branch'))
            $branches = $this->search($request, $branches);
        $branches = $branches->paginate(25);
        $shops = Shop::all();
        return view('backend.branches.index', [
            'branches' => $branches,
            'shops' => $shops,
            'shop_id' => $shop_id
        ]);
    }

    function search($request, $branches) {
        foreach ($request->branch as $key => $value) {
            if (is_numeric($value))
                $branches = $branches->where($key, $value);
            else
                $branches = $branches->where($key, 'like', "%$value%");
        }
        return $branches;
    }

    function create(Request $request, Shop $shop) {
        $data['branch'] = $branch = new Branch;
        $data['shop']=$shop;
        $data['user'] = $user = new \App\Models\User();
        $data['languages'] = Languages::all();
        if ($request->isMethod('POST')){
           // dd($request->all());
            $this->getCityFromLatLng($request->lat,$request->lng);
            return $this->store($request, $branch, $user, $shop);
        }
        return view('backend.branches.create', $data);
    }

    function edit(Request $request, Shop $shop, Branch $branch) {
         $data['branch'] = $branch ;
        $data['shop']=$shop;
        $data['user'] = $user =\App\Models\User::find($branch->id);
        $data['languages'] = Languages::all();
        if ($request->isMethod('POST'))
            return $this->store($request, $branch, $user, $shop);
        return view('backend.branches.update',$data);
    }

    function store(Request $request, $object, $user, $shop) {
        $rules=[];
        foreach (Languages::all() as $one) {
            $rules['name_' . $one->symbole] = 'required';
            $rules['address_' . $one->symbole] = 'required';
        }
        $rules['delivery_distance'] = 'required';
        $rules['full_name'] = 'required';

        if (!($object->exists)) {
            $rules['password'] = 'required';
        }
        if ($user->email != $request->email)
            $rules['email'] = 'required|unique:users,email';

     $validator= \Validator::make($request->all(), $rules);
             
if($validator->fails()){
   
    return redirect()->back()->with('errors',$validator->errors());
}
        $geo_data=$this->getCityFromLatLng($request->lat, $request->lng);
        if(!$geo_data)
            return redirect()->back()->with('errors',['invalide locaion']);
        else {
            $location=Location::where($geo_data)->first();
            if(!is_object($location))
                $location=Location::create($geo_data);
        }
        $user->full_name = $request->full_name;
        $user->type = 1;
        $user->parent = $shop->user_id;

        $user->email = $request->email;
        if ($request->has('password') && $request->password != '')
            $user->password = Hash::make($request->password);
        $user->mail_confirmed = 1;
        $user->save();

        $object->status = 1;
        $object->id=$user->id;
        //$object->id = $user->id;
        $object->time = $request->time;
        $object->shop_id = $shop->id;
        $object->lat = $request->lat;
        $object->lng = $request->lng;
        $object->delivery_distance = $request->delivery_distance;
        $object->location_id=$location->id;
        $object->save();
       // dd($object);
        foreach (Languages::all() as $lang) {
            $objectlang = BranchLang::where('branch_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new BranchLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->address = $request->get('address_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->branch_id = $object->id;
            $objectlang->save();
        }
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Branch $branch) {
        $branch->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح']);
    }

    function test(Request $request){
        $this->getCityFromLatLng($request->lat,$request->lng);
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

}
