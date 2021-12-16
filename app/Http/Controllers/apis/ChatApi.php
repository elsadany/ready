<?php

namespace App\Http\Controllers\apis;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use Illuminate\Support\Facades\Validator;

class ChatApi extends Controller
{
    function send(Request $request){
        $v=Validator::make($request->all(),[
            'message'=>'required',
        ]);
        if($v->fails())
            return response()->json(['status'=>false,'message'=>trans('messages.invalide_data'),'errors'=>$v->errors()]);
        
        $chat=new Chat;
        if(auth()->guard('api')->check()){
            $chat->user_id=auth()->guard('api')->user()->id;
        }else{
            $chat->user_id=$request->user_id;
            $chat->from_admin=true;
            //$chat->admin_id=auth()->guard('admin')->user()->id;
        }
        $chat->message=$request->message;
        $chat->is_read=false;
        $chat->save();

        $chat_resource=new ChatResource($chat);
        event(new ChatMessageEvent($chat_resource));
        return response()->json(['status'=>true,'message'=>trans('messages.success'),'data'=>$chat_resource]);

    }

    function getUserMessages(Request $request){
        if(auth()->guard('api')->check()){
            $user_id=auth()->guard('api')->user()->id;
        }else{
            $v=Validator::make($request->all(),[
                'user_id'=>'required|int|exists:users,id',
            ]);
            $user_id=$request->user_id;
            if($v->fails())
                return response()->json(['status'=>false,'message'=>trans('messages.invalide_data'),'errors'=>$v->errors()]);
        }

        $chat=Chat::where('user_id',$user_id)->orderBy('id','desc')->get();
        $chat_resource=ChatResource::collection($chat);
        $chat_resource=(new Collection($chat_resource))->reverse()->values()->all();
        Chat::where('user_id',$user_id)->update(['is_read'=>1]);
        return response()->json(['status'=>true,'message'=>trans('messages.success'),'data'=>$chat_resource]); 
    }
}
