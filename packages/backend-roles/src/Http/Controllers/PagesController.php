<?php

namespace Elsayednofal\BackendRoles\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Elsayednofal\BackendRoles\Models\Pages;
use DB;
use Elsayednofal\BackendRoles\Models\UsersRoles;

class PagesController extends Controller {

    function anyIndex(Request $request) {
        $object = new Pages;
        if ($request->has('pages')) {
            foreach ($request->pages as $key => $value) {
                if (is_numeric($value)) {
                    $object = $object->where($key, $value);
                } else {
                    $object = $object->where($key, 'like', $value . '%');
                }
            }
        }
        $data['data'] = $object->paginate(15);
        return view(config('backend-roles.templates_path') . '.backend-roles.pages.' . config("backend-roles.bootstrap_v") . '.index', $data);
    }

    function anyCreate(Request $request) {
        $data = [];
        $data['pages_obj'] = new Pages();
        if ($request->method() == 'POST') {
            $data['pages_obj'] = $this->store(new Pages(), $request);
        }
        return view(config('backend-roles.templates_path') . '.backend-roles.pages.' . config("backend-roles.bootstrap_v") . '.create', $data);
    }

    function anyUpdate(Request $request, $id) {
        $pages = pages::find($id);
        if (!$pages)
            abort(404);
        $data['pages_obj'] = $pages;
        if ($request->method() == 'POST') {
            $data['pages_obj'] = $this->store($pages, $request);
        }
        return view(config('backend-roles.templates_path') . '.backend-roles.pages.' . config("backend-roles.bootstrap_v") . '.update', $data);
    }

    function anyDelete($id) {
        $pages = Pages::find($id);
        $response = new \stdClass();
        if (!$pages) {
            $response->status = 'warning';
            $response->message = 'raw not found';
        } else {
            $pages->delete();
            $response->status = 'ok';
            $response->message = 'Delete Successfully';
        }
        return json_encode($response);
    }

    function store(Pages $pages, Request $request) {
        DB::beginTransaction();
        try {
            $pages->fill($this->resolveImageArrayRequest($request->pages));
            if (!$pages->validate()) {
                Session::flash('validate_errors', implode('<br/>', $pages->errors()->all()));
                throw new \Exception('validate errors');
            }
            $pages->save();

            DB::commit();
            Session::flash('success', 'Saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
        }
        return $pages;
    }

    function resolveImageArrayRequest($request) {
        $result = [];
        foreach ($request as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $value[0];
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    function generate(Request $request) {
        if ($request->has('delete_old')) {
            Pages::where('id', '>', 0)->delete();
        }
        $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();

        $da = [];
        //dd($routeCollection);
        //echo "<pre/>";
        foreach ($routeCollection as $route) {
            
            if (key_exists('middleware', $route->action) && $this->checkMiddleware($route->action['middleware'])) {
                if (key_exists('controller', $route->action)) {
                    $page_data = $this->getControllerAndFunctionFromNameSpace($route->action['controller']);
                } else {
                    $page_data['controller'] = null;
                    $page_data['function'] = null;
                }
                if ($route->compiled != null) {
                    $insert_data['regx_link'] = $route->compiled->getRegex();
                } else {
                    //$da[]=$route;
                    //$insert_data['regx_link']=NULL;
                    $insert_data['regx_link'] = $this->gernrateRegxFromUri($route->uri);
                }

                $insert_data['link'] = $route->uri;
                $insert_data['name'] = ucfirst($page_data['controller']);
                $insert_data['module'] = $page_data['controller'];
                $insert_data['action'] = $page_data['function'];
                $page=Pages::where($insert_data)->first();
                if(!is_object($page)){
                    try{
                        Pages::insert($insert_data);
                        
                    } catch (\Exception $ex) {
                        //\Illuminate\Support\Facades\Log::emergency([$ex,$route]);
                    }
                }
                //$da[]=$insert_data;
            }
        }
    }

    private function gernrateRegxFromUri($uri) {
        $regx = '#^/';
        $uri = str_replace('{', '(?P<', $uri);
        $uri = str_replace('}', '>[^/]++)', $uri);
        $regx .= $uri . '$#s';
        return $regx;
    }

    private function checkMiddleware($middlewares) {
        if(!$middlewares)return false;
        foreach ($middlewares as $middleware) {
            if (in_array($middleware, ['auth:admin'])) {
                return true;
            }
        }
        return false;
    }

    private function getControllerAndFunctionFromNameSpace($namespace) {
        $segments = explode('\\', $namespace);
        $con_fun = end($segments);
        $con_fun_seg = explode('@', $con_fun);
        $result['controller'] = strtolower(str_replace('Controller', '', $con_fun_seg[0]));
        $result['function'] = strtolower(str_replace(['any', 'post', 'get'], '', $con_fun_seg[1]));
        return $result;
    }
    
    function urlMatcher(Request $request){
        
//        preg_match('#/backend/pages/delete/(?P<id>[^/]++)$#s','http::///backend/pages/delete/1', $matches);
//        dd($matches);
        
        $res=new \stdClass();
        
        if(!$request->urls){
            $res->message='error';
            return json_encode($res);
        }

        /* check if the user has a role */
        $user_role= UsersRoles::join('roles','roles.id','=','users_roles.role_id')
                    ->where('user_id',auth()->guard('admin')->user()->id)
                    ->select('users_roles.*','roles.is_super')->first();
        if(!is_object($user_role)){
            $res->message='error';
            return json_encode($res);
        }
        /* =============================== */
        
        /** return pages whiche assgined to this user */
        $role_pages= \Elsayednofal\BackendRoles\Models\RolesPages::where('role_id',$user_role->role_id)->pluck('page_id')->toArray();
        if(count($role_pages)==0){
            $res->message='error';
            return json_encode($res);
        }
        /**=============================================== */
        
        /** check if role pages has link and regx or not */
        $pages=\DB::select('select ifnull(regx_link,link) as link , (case when regx_link is null then 0 else 1 end ) as is_regx from pages where id in ('.implode(',', $role_pages).')');
        $result=[];
        /**=============================================== */
        

        $all_pages=\DB::select('select ifnull(regx_link,link) as link , (case when regx_link is null then 0 else 1 end ) as is_regx from pages');

        $sayed=[];
        /** loop for all page urls and validate each one */
        foreach($request->urls as $url){
            $url_not_registered=true;// let url not registered in system page 

            // check if url not on /backend 
            if(!strstr($url, config('backend-roles.url_prefix')."/")){
                $result[]=$url;
                continue;
            }

            // loop for all pages and check if url appear in database 
            // if appear then url_not registered=false
            foreach($all_pages as $page){
                $pattern= str_replace("#^", '#', $page->link);
                try{
                    preg_match($pattern,$url, $matches);
                }catch(\Exception $ex){}
                if(count($matches)>0){
                    $url_not_registered=false;
                    break;
                }
            }

            // if url not regitered then url if valide and continue
            if($url_not_registered){
                $result[]=$url;
                continue;
            }

            // if url registered 
            // then check if appeare in role page => then it valide , else nothing.
            foreach($pages as $page){
                $pattern= str_replace("#^", '#', $page->link);
                try{
                    preg_match($pattern,$url, $matches);
                }catch(\Exception $ex){}  
                
                if(count($matches)>0){
                    $result[]=$url;
                }
                $sayed[]=['link'=>$pattern,'url'=>$url,'check'=>count($matches)];
            }
        }
       // dd($result);

        /** return results */
        $res->message='ok';
        $res->data=$result;
        return json_encode($res);
        
    }
    
    
}
