<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GeneralTag extends Model
{
    use Language;
        protected $appends=['name','imagepath'];
        protected $hidden=['created_at','updated_at'];
                function langs(){
        return $this->hasMany(GeneralTagLang::class,'general_tag_id');
    }
   function getNameAttribute(){
        if(session('lang_id')!=null)
            return $this->lang(session ('lang_id'))->name;
        return $this->lang()->name;
    }
     function getImagepathAttribute() {
        if ($this->image)
            return url('uploads/' . $this->image);
        return '';
    }
}
