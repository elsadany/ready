<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

class BackendNotificationController extends Controller
{
    function index(Request $request){
        
    }
    function store($title,$body,$link){
        $notification=new \App\Models\BackendNotification;
        $notification->title=$title;
        $notification->body=$body;
        $notification->link=$link;
        $notification->save();
        return TRUE;
    }
}
