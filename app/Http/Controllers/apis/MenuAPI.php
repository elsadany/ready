<?php

namespace App\Http\Controllers\apis;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;

class MenuAPI extends Controller
{
    function get(Request $request,$shop_id){
        $menu=Menu::where('shop_id',$shop_id)->where('approved',1)->pluck('category_id')->toArray();
        $categories= \App\Models\ShopCategory::whereIn('id',$menu)->get();
        $data=[];
        foreach($categories as $key=>$row){
            $data[$key]['name']=$row->lang($request->lang_id)->name;
            $menus= Menu::where('shop_id',$shop_id)->where('approved',1)->where('avilability',1)->where('category_id',$row->id)->get();
            $data[$key]['products']=MenuResource::collection($menus);
        }
        return $data;
    }
}
