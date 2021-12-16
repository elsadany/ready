<?php

namespace App\Http\Controllers\backend;

use App\Models\Offer;
use App\Models\OfferBranches;
use App\Models\OfferMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class HomePageController extends Controller {

    function index(Request $request) {

      $data['home_page']=$hope_page= \App\Models\HomePage::first();
      if(!is_object($hope_page))
        $data['home_page']=new \App\Models\HomePage;  
      $data['categories']= \App\Models\Category::all();
      $data['filters']= \App\Models\GeneralTag::all();
       if ($request->isMethod('post')){
           \App\Models\HomePageProperty::orderBy('id','desc')->delete();
          if(!is_object($hope_page))
              $hope_page=new \App\Models\HomePage;
          $hope_page->show_recent=$request->show_recent;
          $hope_page->show_nearest= $request->show_nearest;
          $hope_page->save();
          foreach ($request->types as $key=>$type){
          $property=new \App\Models\HomePageProperty();
          $property->type=$type;
         if(array_key_exists($key, $request->categories))
          $property->category_id=$request->categories[$key];
         if(array_key_exists($key, $request->filters))
          $property->tag_id=$request->filters[$key];
         $property->home_page_id=$hope_page->id;
         $property->save();
       }
       }
           
        return view('backend.home_page.index', $data);
    }

    

}
