<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function index(Request $request){
        $users=User::where('id','>',0);
        if($request->has('user')){
            $users=$this->search($request,$users);
        }
        $users=$users->paginate(25);
        return view('backend.users.index')->with('users',$users);
    }

    function search($request,$users){
        foreach($request->users as $key=>$value){
            if(is_numeric($value))
                $users=$users->where($key,$value);
            else
                $users=$users->where($key,'like',"%$value%");    
        }
        return $users;
    }

    function create(Request $request){
        $user=new User;
        if($request->isMethod('POST'))
            return $this->store($request,$user);
        return view('backend.users.create')->with('user',$user);
    }

    function edit(Request $request,User $user){
        if($request->isMethod('POST'))
            return $this->store($request,$user);
        return view('backend.users.edit')->with('user',$user);    
    }

    function store(Request $request,User $user){
        $request->validate([
            'user.user_name'=>'required|'.($request->id)?'|unique:users,id,'.$request->id:'',
            'user.email'=>'required|email|'.($request->id)?'|unique:users,id,'.$request->id:'',
            'user.full_name'=>'required',
            'password'=>'min:8|confirmed'.($request->id)?'':'|required',
            'user.type'=>'required',
            'user.status'=>'required|boolean'
        ]);

        $user->fill($request->user);
        $user->password=Hash::make($request->password);
        $user->mail_confirmed=1;
        $user->save();
        return redirect()->back()->with('success','تم الحفظ بنجاح');
    }

    function delete(Request $request,User $user){
        $user->delete();
        return response()->json(['status'=>true,'message'=>'تم حذف المستخدم بنجاح']);
    }
}