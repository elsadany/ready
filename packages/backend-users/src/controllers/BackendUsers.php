<?php

namespace ElsayedNofal\BackendUsers\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ElsayedNofal\BackendUsers\Models\User;
use ElsayedNofal\Helpers\controllers\Mail;
use Elsayednofal\MediaManager\Controllers\MediaController;

class BackendUsers extends Controller{

    function index(Request $request){
        $users=User::orderBy('id', 'DESC');
        if($request->search){
            $users=$this->search($request,$users);
        }
        $data['users']=$users->paginate(20);
        return view('BackendUsers::backend-users.index',$data);
    }

    function search(Request $request,$users){
        foreach($request->user as $key=>$value){
            if($key=='page' || $key=='search' || $value=='')continue;

            if(is_numeric($value)){
                $users=$users->where($key,$value);
            }else{
                $users=$users->where($key,'like',$value.'%');
            }
        }
        return $users;
    }

    function create(Request $request){
        return view('BackendUsers::backend-users.create')->with('user',new User);
    }

    function update(Request $request,User $user){
        return view('BackendUsers::backend-users.update')->with('user',$user);
    }

    function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required'.($request->id)?'|unique:backend_users,id,'.$request->id:'',
            'password'=>'min:8|confirmed'.($request->id)?'':'|required',/*|regex:/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',*/
            'phone'=>'sometimes',
        ]);


        $user=User::findOrNew($request->id);
        $user->email=$request->email;
        $user->name=$request->name;
        $user->phone=$request->phone;
        if($request->password!='')
            $user->password=Hash::make($request->password);
        if($request->image!='')
            $user->image=$request->image[0];    
            // $user->image=MediaController::moveTempImage($request->image);
        $user->created_by=Auth::guard('admin')->user()->id;
        $user->save();
        if($request->has('users_roles')){
            $user_role= \Elsayednofal\BackendRoles\Models\UsersRoles::firstOrNew(['user_id'=>$user->id]);
            $user_role->user_id=$user->id;
            $user_role->role_id=$request->users_roles['role_id'];
            if(!$user_role->validate()){
                Session::flash('v_errors', implode('<br/>', $user_role->errors->all()));
                throw new \Exception('Validte Error '.implode('<br/>', $user_role->errors->all()));
            }
            $user_role->save();
        }
        if($request->server('REMOTE_ADDR')!='::1')
            $this->sendCreditionalMail($user,$request->password);
        return redirect()->back()->with('success','Data Saved Successfully');
    }

    function sendCreditionalMail(User $user,$password){
        $to=$user->email;
        $subject='Welcome '.$user->name;
        $message=view('BackendUsers::backend-users.welcome-mail',['user'=>$user,'password'=>$password]);
        $from=config('backend-users.mail_from');
        Mail::send($from,$to,$subject,$message);
    }

    function delete(Request $request,User $user){
        $user->delete();
        return response()->json(['message'=>'user deleted successfully']);
    }

    function profile(Request $request){
        if($request->isMethod('POST')){
            $user=Auth::guard('admin')->user();
            $request->validate([
                'name'=>'required',
                'email'=>'required|unique:backend_users,id,'.$user->id,

                'password'=>$request->password?'sometimes|min:8|confirmed':'',/*|regex:/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',*/
                'phone'=>'sometimes',
            ]);
            $user->email=$request->email;
            $user->name=$request->name;
            $user->phone=$request->phone;
            if($request->password!='')
                $user->password=Hash::make($request->password);
            if($request->image!='')
                $user->image=$request->image[0];
            $user->save();
            return redirect()->back()->with('sucess','Data Saved Successfully');
        }
        return view('BackendUsers::backend-users.profile');
    }

}