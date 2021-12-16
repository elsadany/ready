<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table='cart';
    protected $guarded=['id'];
    protected $casts=['add_ids'=>'array'];



    public function items(){
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    
    
    
}
