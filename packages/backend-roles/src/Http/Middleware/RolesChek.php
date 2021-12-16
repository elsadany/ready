<?php

namespace Elsayednofal\BackendRoles\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Elsayednofal\BackendRoles\Models\UsersRoles;
use Elsayednofal\BackendRoles\Models\RolesPages;


class RolesChek
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
        // ceck is super and cach data
        $user_role= UsersRoles::join('roles','roles.id','=','users_roles.role_id')
                    ->where('user_id',auth()->guard('admin')->user()->id)
                    ->select('users_roles.*','roles.is_super')->first();
        if(!is_object($user_role)){
            return redirect(config('backend-roles.url_prefix').'/roles/lock');
        }
        
        if($user_role->is_super==1){
            return $next($request);
        }
        
        $role_pages= \Elsayednofal\BackendRoles\Models\RolesPages::where('role_id',$user_role->role_id)->pluck('page_id')->toArray();
        if(count($role_pages)==0){
            return redirect(config('backend-roles.url_prefix').'/roles/lock');
        }
        
        $pages=\DB::select('select ifnull(regx_link,link) as link , (case when regx_link is null then 0 else 1 end ) as is_regx from pages where id in ('.implode(',', $role_pages).')');
        //dd($pages);
        foreach($pages as $page){
            try{
                preg_match($page->link,'/'.$request->path(), $matches);
            }catch(\Exception $ex){}
            if(count($matches)>0){
                return $next($request);
            }
        }
        
        return redirect(config('backend-roles.url_prefix').'/roles/lock');
    }
}
