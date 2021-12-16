<?php

namespace App\Http\Controllers\shops;

use App\Models\Menu;
use App\Models\MenuAdd;
use App\Models\Category;
use App\Models\MenuLang;
use App\Models\MenuChoose;
use App\Models\MenuAddLang;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Models\MenuChooseLang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;


class MenuAvailibalityController extends Controller
{

    function __construct(){
        view()->share('langs',Languages::all());
    }

    function index(Request $request){
        $menu=Menu::where('shop_id',auth()->guard('shop')->user()->id)
        ->with('langs');
        if($request->has('menu'))
            $menu=$this->search($request,$menu);
        $menu=$menu->get();
        $menu=$this->handelMenuArray($menu);
        //dd($menu);
        return view('shops.availibility.index',['menu'=>$menu]);
    }

    function handelMenuArray($menu){
        $result=[];
        foreach($menu as $row){
            $result[$row->category_id][]=$row;
        }
        return $result;
    }

    function search($request,$menu){
        foreach($request->menu as $key=>$value){
            if($value=='')continue;
            if(is_numeric($value)){
                $menu=$menu->where($key,$value);
            }else{
                $menu=$menu->where($key,'like',"%$value%");
            }
        }
        if($request->has('addes'))
            $menu=$menu->whereHas('addes');
        if($request->has('chooses'))
            $menu=$menu->whereHas('chooses');
        return $menu;
    }

   
    function availiable(Request $request, MenuChoose $menu){
        $menu->avilability=$request->available;
        $menu->save();
        return ['status'=>true];
    }
    function choose(Request $request, Menu $menu){
        $menu->avilability=$request->available;
        $menu->save();
        
        return ['status'=>true];
    }
    function adds(Request $request, MenuAdd $menu){
        $menu->avilability=$request->available;
        $menu->save();
        return ['status'=>true];
    }
}
