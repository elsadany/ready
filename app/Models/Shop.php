<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Language;
use App\Models\ShopLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model {

    use HasFactory,
        Language;

    protected $guareded = [];
    protected $casts = [
        'cuisine_id'
    ];

    function language() {
        return $this->hasMany(ShopLang::class, 'shop_id');
    }

    function langs(){
        return $this->hasMany(ShopLang::class, 'shop_id');
    }
   

    function cuisines() {
        return $this->hasMany(ShopsCuisine::class, 'shop_id');
    }
    function tags() {
        return $this->hasMany(ShopsTag::class, 'shop_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
        

    function getCategoryAttibute() {
        $category = Category::find($this->category_id);
        if (is_object($category))
            return $category->language->name;
        return '';
    }

    function getLogopathAttribute() {
        if ($this->logo)
            return url('uploads/' . $this->logo);
        return '';
    }
    function getCoverpathAttribute() {
        if ($this->cover_photo)
            return url('uploads/' . $this->cover_photo);
        return '';
    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function branches()
    {
        return $this->hasMany(Branch::class, 'shop_id');
    }

    
    public function offers()
    {
        return $this->hasMany(Offer::class, 'shop_id');
    }
    function reviews(){
        return $this->hasMany(Review::class)->orderBy('id','desc')->limit(10);
    }
    
    

}
