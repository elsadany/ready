<?php

namespace App\Http\Controllers\backend;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class PromoCodesController extends Controller {

    function index() {
        $data['result'] = PromoCode::all();
        return view('backend.promocodes.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['promocode'] = $promocode = new PromoCode();
        if ($request->isMethod('post'))
            $this->store($request, $promocode);
        return view('backend.promocodes.create', $data);
    }

    function update(Request $request, PromoCode $promocode) {
          $data['languages'] = Languages::all();
        $data['promocode'] = $promocode ; 
         if ($request->isMethod('post'))
            $this->store($request, $promocode);
        return view('backend.promocodes.update', $data);
    }

    function store($request, $object) {
        $rules=[
             'code'=>'required|'.($object->id)?'|unique:promo_codes,code,'.$object->id:'',
           
            'type'=>'required|boolean',
            'discount'=>'required|numeric|min:1',
            'expire'=>'required|after:today',
            'max_discount'=>'required|numeric|min:1',
            'min_total'=>'required'
        ];
        
        $request->validate($rules);
        $object->code=$request->code;
        $object->type=$request->type;
        $object->discount=$request->discount;
        $object->expire_at= $request->expire;
        $object->max_discount=$request->max_discount;
        $object->min_total=$request->min_total;
         $object->save();
    
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, PromoCode $promocode) {
        $promocode->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
