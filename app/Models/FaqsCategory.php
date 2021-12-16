<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FaqsCategory extends Model
{
    use Language;
        protected $appends=['name'];
        protected $hidden=['created_at','updated_at'];
                function langs(){
        return $this->hasMany(FaqsCategoryLang::class,'faqs_category_id');
    }
   function getNameAttribute(){
        if(session('lang_id')!=null)
            return $this->lang(session ('lang_id'))->name;
        return $this->lang()->name;
    }
}
