<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
class FaqController extends Controller
{
    function index(Request $request){
        $data['languages']= Languages::all();
            $data['faqs']=$faqs=Faq::all();
           $data['faqs_categories']= \App\Models\FaqsCategory::all();
    
        return view('backend.faq.index',$data);
    }

    function save(Request $request){
          $request->validate([
            'faq' => 'required',
         
        ]);
      
        Faq::orderBy('id','asc')->delete();
        if($request->faq){
           $first= Languages::first();
           foreach ($request->faq['question_'.$first->symbole] as $key=>$one){
               $faq=new Faq();
               $faq->faqs_category_id=$request->faq['category_id'][$key];
               $faq->save();
               foreach (Languages::all() as $lang){
                   $faqlang=new \App\Models\FaqLang();
                   $faqlang->question=$request->faq['question_'.$lang->symbole][$key];
                   $faqlang->answer=$request->faq['answer_'.$lang->symbole][$key];
                   $faqlang->lang_id=$lang->id;
                   
                   $faqlang->faq_id=$faq->id;
                   $faqlang->save();
               }
           }
        }
        return redirect()->back()->with('success','Data Saved Successfully');
    }
}
