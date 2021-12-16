<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use Language;

    protected $appends = ['imagepath', 'name'];
    protected $hidden = ['created_at', 'updated_at','image'];

    function langs() {
        return $this->hasMany(CategoryLang::class, 'category_id');
    }

    function getImagepathAttribute() {
        if ($this->image)
            return url('uploads/' . $this->image);
        return '';
    }

    function getNameAttribute() {
        if (session('lang_id') != null)
            return $this->lang(session('lang_id'))->name;
        return $this->lang()->name;
    }

}
