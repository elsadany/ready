<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use Language;
    function langs(){
        return $this->hasMany(CuisineLang::class,'cuisine_id');
    }
     function getImagepathAttribute(){
        if($this->image)
            return url('uploads/'.$this->image);
        return '';
    }
}
