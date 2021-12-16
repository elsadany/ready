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


class MenuController extends Controller
{

    function __construct(){
        view()->share('langs',Languages::all());
    }

    function index(Request $request){
        $menu=Menu::where('shop_id',auth()->guard('shop')->user()->id)
        ->with('langs')->with('chooses')->with('adds');
        if($request->has('menu'))
            $menu=$this->search($request,$menu);
        $menu=$menu->get();
        $menu=$this->handelMenuArray($menu);
        //dd($menu);
        return view('shops.menu.index',['menu'=>$menu]);
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

    function create(Request $request){
        view()->share('categories',ShopCategory::where('shop_id',auth()->guard('shop')->user()->id)->get());
        $menu=new Menu;
        if($request->isMethod('POST'))
            return $this->store($request,$menu);
        return view('shops.menu.create',['menu'=>$menu]);
    }

    function edit(Request $request,Menu $menu){
        view()->share('categories',ShopCategory::where('shop_id',auth()->guard('shop')->user()->id)->get());
        if($request->isMethod('POST'))
            return $this->store($request,$menu);
        return view('shops.menu.edit',['menu'=>$menu]);
    }

    function store(Request $request,Menu $menu){
        //dd($request->all());
        $request->validate([
            'menu.category_id'=>'required',
            'menu.price'=>'required',
         
        ]);
        
        DB::beginTransaction();
        try{
            //dd(auth()->guard('shop')->user()->id);
            $menu->shop_id=auth()->guard('shop')->user()->id;
            $menu->category_id=$request->menu['category_id'];
            $menu->price=$request->menu['price'];
            $menu->category_id=$request->menu['category_id'];
            if($request->image!=''){
                $menu->image=$request->image;
            }
            if($request->chooses){
                $menu->has_chooses=1;
            }else{
                $menu->has_chooses=0;
            }
            $menu->save();

            $langs=Languages::all();

            //foreach($langs as $lang){
                foreach($request->lang as $lang_id=>$row){
                    $lang=MenuLang::firstOrNew(['menu_id'=>$menu->id,'lang_id'=>$lang_id]);
                    $lang->menu_id=$menu->id;
                    $lang->lang_id=$lang_id;
                    $lang->name=$row['name'];
                    //$lang->desc=$request->lang[$lang->id]['name'][$key];
                    $lang->desc='test';
                    $lang->save();
                }
            //}
            

            if($request->chooses){
                foreach($request->chooses['price'] as $key=>$price){
                    if(isset($request->chooses['id'][$key]))
                        $choose=MenuChoose::findOrNew($request->chooses['id'][$key]);
                    else
                        $choose=new MenuChoose;
                    $choose->menu_id=$menu->id;
                    $choose->price=$price;
                    $choose->save();
                    foreach($langs as $lang){
                        foreach($request->chooses['lang'][$lang->id]['name'] as $name){
                            $choose_lang=MenuChooseLang::firstOrNew(['choose_id'=>$choose->id,'lang_id'=>$lang->id]);
                            $choose_lang->lang_id=$lang->id;
                            $choose_lang->choose_id=$choose->id;
                            $choose_lang->name=$name;
                            $choose_lang->save();
                        }
                    }
                }
            }

            if($request->addes){
                foreach($request->addes['price'] as $key=>$price){
                   // dd($price);
                    if(isset($request->addes['id'][$key]))
                        $menu_add=MenuAdd::findOrNew($request->addes['id'][$key]);
                    else
                        $menu_add=new MenuAdd;
                    $menu_add->menu_id=$menu->id;
                    $menu_add->price=$price;
                    $menu_add->save();

                    foreach($langs as $lang){
                        foreach($request->addes['lang'][$lang->id]['name'] as $name){
                            $menu_add_lang=MenuAddLang::firstOrNew(['add_id'=>$menu_add->id,'lang_id'=>$lang->id]);
                            $menu_add_lang->add_id=$menu_add->id;
                            $menu_add_lang->lang_id=$lang->id;
                            $menu_add_lang->name=$name;
                            $menu_add_lang->desc=$request->addes['lang'][$lang->id]['desc'][$key];
                            $menu_add_lang->save();
                        }
                    }
                    
                }
            }
            
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            throw $ex;
        }    
           
        return redirect()->back()->with('success','Data Saved Successfully');  
    }
    
    function delete(Menu $menu){
        
    }
}
