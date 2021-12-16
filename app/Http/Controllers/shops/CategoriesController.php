<?php

namespace App\Http\Controllers\Shops;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Models\ShopCategoryLang;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class CategoriesController extends Controller
{
    function __construct(){
        view()->share('langs',Languages::all());
    }

    function index(Request $request){
        $categories=ShopCategory::where('shop_id',auth()->guard('shop')->user()->id);
        if($request->has('category'))
            $categories=$this->search($request,$categories);
        $data['categories']=$categories->paginate(25);
        return view('shops.categories.index',$data);
    }

    function search($request,$categories){
        foreach($request->category as $key=>$value){
            if($value=='')continue;
            if(is_numeric($value)){
                $categories=$categories->where($key,$value);
            }else{
                $categories=$categories->where($key,'like',"%$value%");
            }
            return $categories;
        }
    }

    function create(Request $request){
        $category=new ShopCategory();
        if($request->isMethod('POST'))
            return $this->store($request,$category);
        return view('shops.categories.create',['category'=>$category]);
    }

    function edit(Request $request,ShopCategory $category){
        if($request->isMethod('POST'))
            return $this->store($request,$category);
        return view('shops.categories.edit',['category'=>$category]);
    }

    function store(Request $request,ShopCategory $category){
        $request->validate([
            'categoty.*.name'=>'required'
        ]);
        $category->shop_id=auth()->guard('shop')->user()->id;
        $category->save();
        foreach($request->category as $lang_id=>$obj){
            $lang=ShopCategoryLang::where('lang_id',$lang_id)->where('shop_category_id',$category->id)->firstOrNew();
            $lang->shop_category_id=$category->id;
            $lang->lang_id=$lang_id;
            $lang->name=$obj['name'];
            $lang->save();
        }
        return redirect()->back()->with('success','تم حفظ البيانات بنجاح');
    }

    function delete(ShopCategory $category){
        $category->delete();
        return response()->json(['status'=>true,'message'=>'تم الحذف بنجاح']);
    }
}
