<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table='home_page';
    function properties(){
        return $this->hasMany(HomePageProperty::class,'home_page_id');
    }
}
