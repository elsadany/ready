<?php

namespace App\Http\Controllers\backend;

use App\Models\Offer;
use App\Models\OfferBranches;
use App\Models\OfferMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class OffersController extends Controller {

    function index(Request $request, $shop_id = null) {

        $data['result'] = new Offer;
        $data['shop_id']=$shop_id;
        if ($shop_id!=null)
            $data['result'] = $data['result']->where('shop_id', $shop_id);
        $data['result'] = $data['result']->orderBy('id', 'desc')->get();
        $data['shops'] = \App\Models\Shop::all();
        return view('backend.offers.index', $data);
    }

    function accept(Offer $offer) {
        $offer->is_confirmed = 1;
        $offer->save();
        return redirect()->back()->with('success', 'تم القبول بنجاح');
    }

    function refuse(Offer $offer) {
        $offer->is_confirmed = 2;
        $offer->save();
        return redirect()->back()->with('success', 'تم الرفض بنجاح');
    }

}
