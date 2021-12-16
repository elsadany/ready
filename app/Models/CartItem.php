<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\MenuChoose;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $casts=['add_ids'=>'array'];


    
    public function Cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    
    public function choose()
    {
        return $this->belongsTo(MenuChoose::class, 'choose_id');
    }
    
    
}
