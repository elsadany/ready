<?php

namespace App\Http\Controllers\backend;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    function index(){
        // $users=Chat::whereIn('id', function($q){
        //     $q->select(\DB::raw('MAX(id) FROM chats GROUP BY user_id'));
        // })->with('user')->get();
        return view('backend.chat.index');
    }

    function getUsers(){
        //$users=Chat::OrderBy('id','desc')->groupBy('user_id')->distinct('user_id')->get();
        $users=Chat::whereIn('id', function($q){
            $q->select(\DB::raw('MAX(id) FROM chats GROUP BY user_id'));
        })->with('user')->get();
        return response()->json($users);
    }
}
