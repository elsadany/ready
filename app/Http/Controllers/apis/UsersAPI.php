<?php

namespace App\Http\Controllers\apis;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class UsersAPI extends Controller {

    function myacount(Request $request) {
        $user = $request->user();
        $arr = ['status' => true, 'message' => '', 'data' => $user->toArray()];
        return response()->json($arr);
    }
    function updateNotification(Request $request) {
         $validator = Validator::make($request->all(), [
//                    'notification' => 'required',
                        'notification' => 'boolean'
        ]);
     
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $validator->errors()]);
       
        $user = $request->user();
        $user->notification=$request->notification;
        $user->save();
        $arr = ['status' => true, 'message' => 'success', 'data' => $user->toArray()];
        return response()->json($arr);
    }
    function Notifications(Request $request) {
      
        if(\App\Models\Notification::where('user_id',$request->user()->id)->orderBy('id','desc')->count()<1){
            $notifications=new \App\Models\Notification();
            $notifications->user_id=$request->user()->id;
            $notifications->notification='test notification';
            $notifications->save();
            
        }
        $notifications= \App\Models\Notification::where('user_id',$request->user()->id)->orderBy('id','desc')->get();
        $arr = ['status' => true, 'message' => '', 'data' => $notifications->toArray()];
        return response()->json($arr);
    }

    function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                        //'remember_me' => 'boolean'
        ]);
        if ($request->user()->email != $request->email)
            $rules['email'] = 'required|email|unique:users,email';
        if ($request->user()->phone != $request->phone)
            $rules['phone'] = 'required|unique:users,phone';
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $validator->errors()]);
        $user = $request->user();
        $user->full_name = $request->full_name;
        if ($request->hasFile('image')) {
            $user->image = $this->uploadfile($request->image);
        }
        $user->save();
        $arr = ['status' => true, 'message' => 'success', 'data' => $user->toArray()];
        return response()->json($arr);
    }

    function updatePassword(Request $request) {

        $rules = [
            'old_password' => 'required',
            'password' => 'required|string'
        ];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            $arr = ['status' => false, 'message' => $validator->errors()->all()[0]];

            return response()->json($arr);
        }
        if (!Hash::check($request->old_password, $request->user()->password)) {
            $arr = ['status' => false, 'message' => 'password not correct'];
            return response()->json(
                            $arr);
        }
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();
        $arr = ['status' => true, 'message' => 'password changed successfully', 'data' => ''];
        return response()->json($arr);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        $arr = ['status' => true, 'message' => 'Successfully logged out'];
        return response()->json(
                        $arr);
    }

    function getAdreesses(Request $request) {
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function addAdreess(Request $request) {
        $v = Validator::make($request->all(), [
                    'bulding_number' => 'required',
                    'street' => 'required',
                    'details' => 'required',
                    'mobile' => 'required'
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);

        $address = new Address;
        $address->fill($request->all());
        $address->user_id = auth()->guard('api')->user()->id;
        $address->save();

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function updateAdrress(Request $request) {
        $v = Validator::make($request->all(), [
                    'address_id' => 'required|exists:addresses,id'
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);

        $address = Address::find($request->address_id);
        $address->fill($request->all());
        $address->save();

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function deleteAdrress(Request $request) {
        $v = Validator::make($request->all(), [
                    'address_id' => 'required|exists:addresses,id'
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);

        $address = Address::find($request->address_id);
        $address->delete();

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    private function uploadfile($file) {
        $path = 'uploads/users';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }
        $datepath = date('m-Y', strtotime(\Carbon\Carbon::now()));
        if (!file_exists($path . '/' . $datepath)) {
            mkdir($path . '/' . $datepath, 0775);
        }
        $newdir = $path . '/' . $datepath;
        $exten = $file->getClientOriginalExtension();
        $filename = $this->generateRandom($length = 15);
        $filename = $filename . '.' . $exten;
        $file->move($newdir, $filename);
        return $path . '/' . $filename;
    }

    private function generateRandom($length = 11) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function myOrders(Request $request) {
        $orders = \App\Models\Order::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => \App\Http\Resources\OrderResource::collection($orders)
        ]);
    }

    function updateDeviceId(Request $request) {
        $v = Validator::make($request->all(), [
                    'device_id' => 'required',
        ]);

        if ($v->fails())
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);
        $user = auth()->guard('api')->user();
        $user->device_id = $request->device_id;
        $user->save();
        return response()->json(['status' => 200, 'message' => 'success']);
    }

    function showOrder(Request $request) {
        $v = Validator::make($request->all(), [
                    'order_id' => 'required|exists:orders,id'
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()]);
        $order = \App\Models\Order::where('user_id', $request->user()->id)->where('id', $request->order_id)->first();
        if (!is_object($order))
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => [trans('messages.invalide_data')]]);

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => new \App\Http\Resources\OrderResource($order)
        ]);
    }

    function showLastOrder(Request $request) {

        $order = \App\Models\Order::where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
        if (!is_object($order))
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => [trans('messages.invalide_data')]]);

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => new \App\Http\Resources\OrderResource($order)
        ]);
    }

    function Notify(Request $request) {

        $order = \App\Models\Order::where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
        if (!is_object($order))
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => [trans('messages.invalide_data')]]);

        return response()->json([
                    'status' => true,
                    'message' => trans('messages.success'),
                    'data' => ''
        ]);
    }

}
