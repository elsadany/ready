<?php

namespace Elsayednofal\BackendRoles\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendRoles\Models\Roles;
use DB;
use Illuminate\Support\Facades\Session;
use Elsayednofal\BackendRoles\Models\Pages;
use Elsayednofal\BackendRoles\Models\RolesPages;
/**
 * Description of RolesController
 *
 * @author Elsayed
 */
class RolesController extends Controller{
    
    function index(Request $request){
        
        $object= new Roles;
        if($request->has('roles')){
            foreach($request->roles as $key=>$value){
                if(is_numeric($value)){
                    $object=$object->where($key,$value);
                }else{
                    $object=$object->where($key,'like',$value.'%');
                }
            }
        }
        $data['data']=$object->get();
        return view(config('backend-roles.templates_path').'.backend-roles.roles.'.config("backend-roles.bootstrap_v").'.index',$data);
    }
    
    function create(Request $request){
        $role=new Roles;
        if($request->isMethod('POST') && $this->store($request,$role)){
            Session::flash('success','data saved successfully');
            $role=new Roles;
        }       
        $data['role']=$role;
        return view(config('backend-roles.templates_path').'.backend-roles.roles.'.config("backend-roles.bootstrap_v").'.create',$data);
    }
    
    function update(Request $request,$id){
        $role=Roles::find($id);
        if($request->isMethod('POST') && $this->store($request, $role)){
            Session::flash('success','data saved successfully');
        }
        $data['role']=$role;
        return view(config('backend-roles.templates_path').'.backend-roles.roles.'.config("backend-roles.bootstrap_v").'.update',$data);
    }
    
    function store(Request $request, Roles $role){
        DB::beginTransaction(); 
        try{
            $role->fill($request->role);
            if(!isset($request->role['is_super'])){
                $role->is_super=0;
            }
            if(!$role->validate()){
                Session::flash('validate_errors', implode('<br/>', $role->errors()->all()));
                throw new \Exception('Validate Error',123);
            }
            $role->save();
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            if($ex->getCode()!=123)
                throw $ex;
        }
    }
    
    function actions(Request $request,$role_id){
        $db_pages= Pages::all();
        $pages=[];
        foreach($db_pages as $page){
            $pages[$page->module][]=$page;
        }
        if($request->isMethod('POST')){
            RolesPages::where('role_id',$role_id)->delete();
            foreach($request->page as $row=>$v){
                RolesPages::create(['role_id'=>$role_id,'page_id'=>$row]);
            }
            Session::flash('success','Data Saved Successfully');
        }
        $data['selected_pages']= RolesPages::where('role_id',$role_id)->pluck('page_id')->toArray();
       // dd($data);
        $data['pages']=$pages;
        return view(config('backend-roles.templates_path').'.backend-roles.roles.'.config("backend-roles.bootstrap_v").'.actions',$data);
    }
    
    function lock(){
        return view(config('backend-roles.templates_path').'.backend-roles.roles.'.config("backend-roles.bootstrap_v").'.lock');
    }
    
}
