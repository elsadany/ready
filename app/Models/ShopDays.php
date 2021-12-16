<?php

namespace App\Models;

use App\Models\Language;
use App\Models\ShopCategoryLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopDays extends Model
{
    use HasFactory;
    protected $hidden=['created_at','updated_at','id','day'];
    protected $table='shop_on_days';
    protected $appends=['dayname'];
    protected $guarded=['id'];
    
      function getDaynameAttribute() {
     if(session('lang_id')==2)
         return en_days[$this->day];
     else
         return days[$this->day];
    }
    
}
