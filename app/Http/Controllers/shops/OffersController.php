<?php

namespace App\Http\Controllers\Shops;

use App\Models\Offer;
use App\Models\OfferBranches;
use App\Models\OfferMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class OffersController extends Controller {

    function index(Request $request) {
        $shop_id = auth()->guard('shop')->user()->id;
        $data['result'] = Offer::where('shop_id', $shop_id)->orderBy('id', 'desc')->get();
        return view('shops.offers.index', $data);
    }

    function create(Request $request) {
        $shop_id = auth()->guard('shop')->user()->id;
       $data['offer']=$offer=new Offer();
        $data['menus']= \App\Models\Menu::where('shop_id',$shop_id)->get();
        $data['branches']= \App\Models\Branch::where('shop_id',$shop_id)->get();
        if ($request->isMethod('POST'))
            return $this->store($request, $offer);
         return view('shops.offers.create', $data);
    }

    function store($request, $offer) {
        $rules=[
            'type'=>'required|boolean',
            'discount'=>'required|numeric|min:1',
      
            'date_from'=>'required|after:after_or_equal:today',
            'date_to'=>'required|after:date_from',
            'all_menu'=>'required|boolean',
            'all_branches'=>'required|boolean',
        ];
        if($request->type==0){
            $rules['discount']='max:99';
        }
             $request->validate($rules);
        $offer->shop_id=auth()->guard('shop')->user()->id;;
        $offer->offer_type=$request->type;
        $offer->discount=$request->discount;
        $offer->min_order=$request->min_order;
        $offer->max_order=$request->max_order;
        $offer->date_from=$request->date_from;
        $offer->date_to=$request->date_to;
        $offer->all_menu=$request->all_menu;
        $offer->all_branches=$request->all_branches;
        $offer->save();
        if($request->has('menu')){
            foreach ($request->menu as $one){
                $offermenu=new OfferMenues();
                $offermenu->menu_id=$one;
                $offermenu->offer_id=$offer->id;
                $offermenu->save();
            }
        }
        if($request->has('branches')){
            foreach ($request->branches as $one){
                $offerbranch=new OfferBranches();
                $offerbranch->branch_id=$one;
                $offerbranch->offer_id=$offer->id;
                $offerbranch->save();
            }
        }
          return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, Offer $offer) {
        
    }

}
