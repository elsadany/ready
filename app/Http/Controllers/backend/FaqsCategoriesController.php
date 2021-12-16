<?php

namespace App\Http\Controllers\backend;

use App\Models\FaqsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaqsCategoryLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class FaqsCategoriesController extends Controller {

    function index() {
        $data['result'] = FaqsCategory::all();
        return view('backend.faqs_categories.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['faqs_category'] = $faqs_category = new FaqsCategory();
        if ($request->isMethod('post'))
            $this->store($request, $faqs_category);
        return view('backend.faqs_categories.create', $data);
    }

    function update(Request $request, FaqsCategory $faqs_category) {
          $data['languages'] = Languages::all();
        $data['faqs_category'] = $faqs_category ; 
         if ($request->isMethod('post'))
            $this->store($request, $faqs_category);
        return view('backend.faqs_categories.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['title_' . $language->symbole] = 'required';
        }
        
        $request->validate($rules);
         $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = FaqsCategoryLang::where('faqs_category_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new FaqsCategoryLang ();
            $objectlang->title = $request->get('title_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->faqs_category_id=$object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, FaqsCategory $faqs_category) {
        $faqs_category->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
