<?php

namespace App\Models;

use App\Models\MenuAdd;
use App\Models\Language;
use App\Models\MenuLang;
use App\Models\MenuChoose;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model {

    use HasFactory,
        Language;

    protected $guarded = ['id'];

    public function langs() {
        return $this->hasMany(MenuLang::class, 'menu_id');
    }

    public function chooses() {
        return $this->hasMany(MenuChoose::class, 'menu_id')->where('avilability',1);
    }

    public function adds() {
        return $this->hasMany(MenuAdd::class, 'menu_id')->where('avilability',1);
    }
    
    function category(){
        return $this->belongsTo(ShopCategory::class,'category_id');
    }
    

    function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    function getImagepathAttribute() {
        if ($this->image != '')
            return url('uploads/'.$this->image);
        return url('item-not-available.svg');
    }

}
