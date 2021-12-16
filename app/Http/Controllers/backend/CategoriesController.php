<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class CategoriesController extends Controller {

    function index() {
        $data['result'] = Category::all();
        return view('backend.categories.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['category'] = $category = new Category();
        if ($request->isMethod('post'))
            $this->store($request, $category);
        return view('backend.categories.create', $data);
    }

    function update(Request $request, Category $category) {
          $data['languages'] = Languages::all();
        $data['category'] = $category ; 
         if ($request->isMethod('post'))
            $this->store($request, $category);
        return view('backend.categories.update', $data);
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
        foreach (Languages::all() as $lang) {
            $objectlang = CategoryLang::where('category_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new CategoryLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->category_id=$object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, Category $category) {
        $category->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
