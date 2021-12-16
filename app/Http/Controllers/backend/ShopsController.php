<?php

namespace App\Http\Controllers\backend;

use App\Models\Shop;
use App\Models\ShopLang;
use App\Models\ShopsCuisine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use App\Models\Category;
use App\Models\User;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;
use Illuminate\Support\Facades\Hash;

class ShopsController extends Controller {

    function index(Request $request) {
        $objects = new Shop;
        if ($request->has('shop'))
            $objects = $this->search($request, $objects);
        $data['result'] = $objects = $objects->paginate(25);
        return view('backend.shops.index', $data);
    }

    function search(Request $request, $objects) {
        foreach ($request->shop as $key => $value) {
            if (is_numeric($value))
                $objects = $objects->where($key, $value);
            else
                $objects = $objects->where($key, 'like', "%$value%");
        }
        return $objects;
    }

    function create(Request $request) {

        $data['shop'] = $object = new Shop;
        $data['user'] = $user = new User;
        $data['cuisines'] = Cuisine::all();
        $data['tags'] = \App\Models\GeneralTag::all();
        $data['categories'] = Category::all();
        $data['languages'] = Languages::all();
        if ($request->isMethod('POST'))
            return $this->store($request, $object, $user);
        return view('backend.shops.create', $data);
    }

    function update(Request $request, Shop $shop) {
        $data['shop'] = $shop;
        $data['tags'] = \App\Models\GeneralTag::all();

        $data['user'] = $user = User::find($shop->user_id);
        $data['cuisines'] = Cuisine::all();
        $data['categories'] = Category::all();
        $data['languages'] = Languages::all();
        if ($request->isMethod('POST'))
            return $this->store($request, $shop, $user);
        return view('backend.shops.update', $data);
    }

    function store(Request $request, Shop $object, User $user) {
        foreach (Languages::all() as $one) {
            $rules['name_' . $one->symbole] = 'required';
        }
        $rules['min_order'] = 'required|integer|min:0';
        $rules['category_id'] = 'required|integer|exists:categories,id';
     
        if ($request->category_id == 1) {
            $rules['cuisines'] = 'required';
            $rules['cuisines.*'] = 'required|exists:cuisines,id';
        }
        $rules['full_name'] = 'required';
        $x = 0;
        if (!($object->exists)) {
            $rules['password'] = 'required';

            $x = 1;
        }
        if (!($object->exists)) {
            $rules['cover_photo'] = 'required';
        }
        if (!($object->exists)) {
            $rules['logo'] = 'required';
        }
        if ($user->email != $request->email)
            $rules['email'] = 'required|' . ($user->id) ? '|unique:users,email,' . $object->id : '';
       
        $request->validate($rules);
        $user->full_name = $request->full_name;
        $user->type = 1;
        $user->parent = 0;
      
        $user->email = $request->email;
        if ($request->has('password') && $request->password != '')
            $user->password = Hash::make($request->password);
        $user->mail_confirmed = 1;
        $user->save();
        $object->id = $user->id;
        $object->has_delivery = $request->has_delivery;
        $object->has_place = $request->has_place;
        $object->category_id = $request->category_id;
        if ($request->has('logo') && $request->logo != '')
            $object->logo = Media::moveTempImage($request->logo);
        if ($request->has('cover_photo') && $request->cover_photo != '')
            $object->cover_photo = Media::moveTempImage($request->cover_photo);
        $object->min_order = $request->min_order;
        $object->dlivary_rime = $request->delivery_time;
        $object->delivery_price = $request->delivery_price;
        $object->user_id = $user->id;

        $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = ShopLang::where('shop_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new ShopLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->shop_id = $object->id;
            $objectlang->save();
        }
        $object->cuisines()->delete();
        if ($request->has('cuisines')) {
            foreach ($request->cuisines as $one) {
                $cuisine = new ShopsCuisine();
                $cuisine->cuisine_id = $one;
                $cuisine->shop_id = $object->id;
                $cuisine->save();
            }
        }
        $object->tags()->delete();
        if ($request->has('tags')) {
            foreach ($request->tags as $one) {
                $tag = new \App\Models\ShopsTag();
                $tag->general_tag_id = $one;
                $tag->shop_id = $object->id;
                $tag->save();
            }
        }

        if ($x == 1)
            return redirect('backend/branches/' . $object->id)->with('success', 'تم الحفظ بنجاح');

        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, Shop $shop) {
        $shop->langs()->delete();
        $shop->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح']);
    }

}
