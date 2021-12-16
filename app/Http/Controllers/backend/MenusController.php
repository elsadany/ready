<?php

namespace App\Http\Controllers\backend;

use App\Models\Menu;
use App\Models\MenuBranches;
use App\Models\MenuMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class MenusController extends Controller {

    function index(Request $request, $shop_id = null) {

        $data['result'] = new Menu;
        $data['shop_id']=$shop_id;
        if ($shop_id!=null)
            $data['result'] = $data['result']->where('shop_id', $shop_id);
        $data['result'] = $data['result']->orderBy('id', 'desc')->get();
        $data['shops'] = \App\Models\Shop::all();
        return view('backend.menus.index', $data);
    }

    function accept(Menu $menu) {
        $menu->approved = 1;
        $menu->save();
        return redirect()->back()->with('success', 'تم القبول بنجاح');
    }

    function refuse(Menu $menu) {
        $menu->approved = 2;
        $menu->save();
        return redirect()->back()->with('success', 'تم الرفض بنجاح');
    }

}
