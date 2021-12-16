<?php

namespace App\Http\Controllers\backend;

use App\Models\OffersNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OffersNotificationLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class OffersNotificationsController extends Controller {

    function index() {
        $data['result'] = OffersNotification::all();
        return view('backend.offers_notifications.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['shops'] = \App\Models\Shop::all();
        $data['offers_notification'] = $offers_notification = new OffersNotification();
        if ($request->isMethod('post'))
            $this->store($request, $offers_notification);
        return view('backend.offers_notifications.create', $data);
    }

    function update(Request $request, OffersNotification $offers_notification) {
        $data['languages'] = Languages::all();
        $data['shops'] = \App\Models\Shop::all();

        $data['offers_notification'] = $offers_notification;
        if ($request->isMethod('post'))
            $this->store($request, $offers_notification);
        return view('backend.offers_notifications.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['title_' . $language->symbole] = 'required';
            $rules['description_' . $language->symbole] = 'required';
        }
       
        $request->validate($rules);
       $object->shop_id=$request->shop_id;
        $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = OffersNotificationLang::where('offers_notification_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new OffersNotificationLang ();
            $objectlang->title = $request->get('title_' . $lang->symbole);
            $objectlang->description = $request->get('description_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->offers_notification_id = $object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, OffersNotification $offers_notification) {
        $offers_notification->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
