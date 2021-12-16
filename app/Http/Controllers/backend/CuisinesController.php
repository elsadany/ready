<?php

namespace App\Http\Controllers\backend;

use App\Models\Cuisine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CuisineLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class CuisinesController extends Controller {

    function index() {
        $data['result'] = Cuisine::all();
        return view('backend.cuisines.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['cuisine'] = $cuisine = new Cuisine();
        if ($request->isMethod('post'))
            $this->store($request, $cuisine);
        return view('backend.cuisines.create', $data);
    }

    function update(Request $request, Cuisine $cuisine) {
          $data['languages'] = Languages::all();
        $data['cuisine'] = $cuisine ; 
         if ($request->isMethod('post'))
            $this->store($request, $cuisine);
        return view('backend.cuisines.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['name_' . $language->symbole] = 'required';
        }
         if (!($object->exists)) {
            $rules['image'] = 'required';
        }
        
        $request->validate($rules);
         if ($request->has('image')&&$request->image!='')
            $object->image = Media::moveTempImage($request->image);
        $object->save();
         $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = CuisineLang::where('cuisine_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new CuisineLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->cuisine_id=$object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, Cuisine $cuisine) {
        $cuisine->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
