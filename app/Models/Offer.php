<?php

namespace App\Models;

use App\Models\OfferMenues;
use App\Models\OfferBranches;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;
    function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }

    
    public function branches()
    {
        return $this->hasMany(OfferBranches::class, 'offer_id');
    }

    
    public function menu()
    {
        return $this->hasMany(OfferMenues::class, 'offer_id');
    }
    
    
}
