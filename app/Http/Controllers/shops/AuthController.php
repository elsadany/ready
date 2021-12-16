<?php

namespace App\Http\Controllers\shops;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\apis\AuthApi;

class AuthController extends Controller
{
    function login(Request $request){
        if($request->isMethod('GET'))
            return view('shops.auth.login');
        $auth_check=(new AuthApi())->login($request);
        $auth_res=$auth_check->getData();
        //dd(!$auth_res->status,$auth_res->data->user->type===1);
        if(!$auth_res->status || $auth_res->data->user->type===2){
            return redirect()->back()->withErrors(['Invalide email or password']);
        }

        $user=User::find($auth_res->data->user->id);
        Auth::guard('shop')->login($user,$auth_res->data->remember);
        return redirect()->route('shops.dashboard');  
    }

    function logout(){
        Auth::guard('shop')->logout();
        return redirect()->route('shops.login');
    }

    function forgetPassword(Request $request){
        if(Auth::guard('shop')->check()){
            return redirect()->route('shops.dashboard'); 
        }
        if($request->isMethod('POST')){
            $user=User::where('email',$request->email)->where('type',1)->first();
            if(!$user){
                return redirect()->back()->withErrors(['البريد الالكترونى غير موجود']);
            }
            $user->reset_password_token=base64_encode(Str::random(32));
            $user->reset_password_at=Carbon::now();
            $user->save();
            if($request->server('REMOTE_ADDR')!='::1')
                $this->sendResetMail($user);
            return redirect()->back()->with('success','تم ارسال رسالة بريد الكترونى الى بريدك .');
        }
        return view('shops.auth.forget-password');
    }

    private function sendResetMail(User $user){
        $from=config('backend-users.mail_from');
        $subject='Reset Mail';
        $message=view('shopd.auth.reset-password-mail')->with('user',$user)->render();
        Mail::send($from,$user->email,$subject,$message);
    }

    function resetPassword(Request $request,$token){
        if(Auth::guard('shop')->check())
            return redirect()->route('shops.dashboard'); 
        
        // get user and check link expire date
        $user=User::where('reset_password_token',$token)->firstOrFail();
        if($user->reset_password_at > Carbon::now()->addHours(24)){
            return redirect()->back()->withErrors(['رابط منتهى']);
        }

        // handel new password
        if($request->isMethod('POST')){
            $request->validate([
                'password'=>'min:8|confirmed|required',/*|regex:/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',*/
            ]);
            $user->password=Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success','تم اعادة ظبط الرقم السرى بنجاح');
        }

        return view('shops.auth.reset-password');
    }
}
