<?php

namespace ElsayedNofal\BackendUsers\controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ElsayedNofal\BackendUsers\Models\User;
use ElsayedNofal\Helpers\controllers\Mail;

class AuthController extends Controller{
    
    function login(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect()->to(config('backend-users.login_redirect')); 
        }
        return view('BackendUsers::auth.login');
    }

    function auth(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember_me)){
            return redirect()->back()->withErrors(['email and password does not match any user !']);
        }
        return redirect()->to(config('backend-users.login_redirect'));
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('./backend');//->route('login');
    }

    function forgetPassword(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect()->to(config('backend-users.login_redirect')); 
        }
        if($request->isMethod('POST')){
            $user=User::where('email',$request->email)->first();
            if(!$user){
                return redirect()->back()->withErrors(['email not exist']);
            }
            $user->reset_password_token=base64_encode(Str::random(32));
            $user->reset_password_at=Carbon::now();
            $user->save();
            if($request->server('REMOTE_ADDR')!='::1')
                $this->sendResetMail($user);
            return redirect()->back()->with('success','تم ارسال رسالة بريد الكترونى الى بريدك .');
        }
        return view('BackendUsers::auth.forget-password');
    }

    private function sendResetMail(User $user){
        $from=config('backend-users.mail_from');
        $subject='Reset Mail';
        $message=view('BackendUsers::auth.reset-password-mail')->with('user',$user)->render();
        Mail::send($from,$user->email,$subject,$message);
    }

    function resetPassword(Request $request,$token){
        if(Auth::guard('admin')->check()){
            return redirect()->to(config('backend-users.login_redirect')); 
        }

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

        return view('BackendUsers::auth.reset-password');
    }


}