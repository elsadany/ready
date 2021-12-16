<?php

namespace App\Models;

use App\Models\Cuisine;
use App\Models\Language;
use App\Models\CuisineLang;
use Illuminate\Database\Eloquent\Model;

class ShopsCuisine extends Model
{

    use Language;
    
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, 'cuisine_id');
    }
    

    
    public function langs()
    {
        return $this->hasMany(CuisineLang::class, 'cuisine_id');
    }
    
    
}
