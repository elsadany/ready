<?php

namespace App\Http\Controllers\backend;

use App\Models\GeneralTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralTagLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class GeneralTagsController extends Controller {

    function index() {
        $data['result'] = GeneralTag::all();
        return view('backend.general_tags.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['general_tag'] = $general_tag = new GeneralTag();
        if ($request->isMethod('post'))
            $this->store($request, $general_tag);
        return view('backend.general_tags.create', $data);
    }

    function update(Request $request, GeneralTag $general_tag) {
          $data['languages'] = Languages::all();
        $data['general_tag'] = $general_tag ; 
         if ($request->isMethod('post'))
            $this->store($request, $general_tag);
        return view('backend.general_tags.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['name_' . $language->symbole] = 'required';
        }
        if (!($object->exists)) {
            $rules['image'] = 'required';
        }
        $request->validate($rules);
          if ($request->has('image') && $request->image != '')
            $object->image = Media::moveTempImage($request->image);
         $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = GeneralTagLang::where('general_tag_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new GeneralTagLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->general_tag_id=$object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, GeneralTag $general_tag) {
        $general_tag->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
