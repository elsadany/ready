<?php

namespace App\Http\Controllers\shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $data['orders']= \App\Models\Order::where('shop_id',auth()->guard('shop')->user()->id)->where('tracking_status','<',3)->get();
        return view('shops.dashboard.index',$data);
    }
    function availiblty(Request $request){
       
        if(auth()->guard('shop')->user()->parent==0){
        $data['branch']=$branch= \App\Models\Branch::where('shop_id',auth()->guard('shop')->user()->id)->first();
        }else{
        $data['branch']=$branch= \App\Models\Branch::where('id',auth()->guard('shop')->user()->id)->first();
        }
        if($request->has('busy')){
            $branch->busy=$request->busy;
            $branch->save();
            
            return redirect()->back()->with('success','Changed Successfully');
        }
      
        return view('shops.dashboard.available',$data);
    }
    function uploadTest(Request $request){
        return view('shops.dashboard.upload');
    }
    function upload(Request $request){
        $image= explode('base64,', $request->image);
        return response()->json(['status'=>200,'response'=> $this->uploadbasfile($image[1])]);
    }
     private function uploadbasfile($file) {
        $path = 'uploads/menus';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }
        $datepath = date('m-Y', strtotime(\Carbon\Carbon::now()));
        if (!file_exists($path . '/' . $datepath)) {
            mkdir($path . '/' . $datepath, 0775);
        }
        $newdir = $path . '/' . $datepath;
        $exten = 'png';
        $filename = $this->generateRandom($length = 15);
        $filename = $filename . '.' . $exten;
        $filedate = base64_decode($file);

        file_put_contents($newdir . '/' . $filename, $filedate);

        return 'menus/'.$datepath . '/' . $filename;
    }
 function generateRandom($length = 11) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

}
