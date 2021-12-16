<?php

namespace Elsayednofal\BackendRoles\Http\Controllers;

use Elsayednofal\BackendRoles\Models\UsersRoles;

class RolesHelper {
    
    function hrefCheker(){
        return view(config('backend-roles.templates_path').'.backend-roles.helpers.href_checker');
    }
    
    function dataActionChecker(){
        
        $user_role= UsersRoles::join('roles','roles.id','=','users_roles.role_id')
                    ->where('user_id',session('backend_user')->id)
                    ->select('users_roles.*','roles.is_super')->first();
        
        if(is_object($user_role) && $user_role->is_super){
            return '';
        }
        $role_pages= \Elsayednofal\BackendRoles\Models\RolesPages::where('role_id',$user_role->role_id)->pluck('page_id')->toArray();
        $pages= \Elsayednofal\BackendRoles\Models\Pages::find($role_pages);
        $actions=[];
        foreach($pages as $page){
            $actions[]=$page->module.'.'.$page->action;
        }
        $data['role_actions']=$actions;
        $data['user_role']=$user_role;
        
        return view(config('backend-roles.templates_path').'.backend-roles.helpers.action_checker',$data);
    }
    
    function checkPage($href){
        
    }
    
    
    
}
