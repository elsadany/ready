<?php

namespace App\Models;

use App\Models\Language;
use App\Models\ShopCategoryLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopCategory extends Model
{
    use HasFactory,Language;

    protected $guarded=['id'];
    
    public function langs()
    {
        return $this->hasMany(ShopCategoryLang::class, 'shop_category_id');
    }
    
}
