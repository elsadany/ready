<?php

namespace App\Http\Controllers\apis;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Cart;
class AuthApi extends Controller {

    function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
                //'remember_me' => 'boolean'
        ]);

        $user = User::where('status', 1)->where('email', $request->email)->first();

        if (!is_object($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'incorrect email or password']);
        }

        if (!$user->mail_confirmed) {
            return response()->json(['status' => false, 'Message' => 'please confirm your account']);
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $response['status'] = true;
        $response['message'] = 'success';
        $response['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'remember' => $request->remember_me ? true : false,
            'user' => $user->only(['id', 'email', 'full_name', 'type'])
        ];
        return response()->json($response);
    }

    function loginapp(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                        //'remember_me' => 'boolean'
        ]);
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $validator->errors()]);
        $user = User::where('status', 1)->where('email', $request->email)->first();
        if (!is_object($user))
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => ['Not Found']]);

        if (!is_object($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'incorrect email or password']);
        }

        if (!$user->mail_confirmed) {
            return response()->json(['status' => false, 'Message' => 'please confirm your account']);
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
if($request->session_id!='')
    Cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        $response['status'] = true;
        $response['message'] = 'success';
        $response['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'remember' => $request->remember_me ? true : false,
            'user' => $user->only(['id', 'email', 'full_name', 'type'])
        ];
        return response()->json($response);
    }

    function register(Request $request) {

        $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|unique:users,email',
                    'password' => 'required|string',
                    'phone' => 'required',
                    'full_name' => 'required',
                        //'remember_me' => 'boolean'
        ]);
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()[0], 'errors' => $validator->errors()]);
        $user = new \App\Models\User;
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->status = 1;
        $user->type = 2;
        $user->mail_confirmed = 1;
        $user->parent = 0;
        $user->save();
if($request->session_id!='')
    Cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $arr['status'] = true;
        $arr['message'] = 'success';
        $arr['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userdata' => $user->toArray()
                //'userdata'=>array_merge($user->toArray(),$user->setting->allow_notifications)
        ];
        return response()->json($arr);
    }

    function loginSocial(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email',
                    'full_name' => 'required|string',
                  
        ]);
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Invalide Data', 'errors' => $validator->errors()]);
        $user = User::where('email', $request->email)->first();

        if (!is_object($user)) {
            $data = $request->all();
            $data['status'] = 1;
            $data['type'] = 2;
            $data['parent'] = 1;
            $data['mail_confirmed'] = 1;
            $user = User::create($data);
        } else {

            $user->phone = $request->phone;
            $user->full_name = $request->full_name;
            $user->save();
        }
if($request->session_id!='')
    Cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();
        $arr['status'] = true;
        $arr['message'] = 'success';
        $arr['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userdata' => $user->toArray()
        ];
        return response()->json($arr);
    }

}
