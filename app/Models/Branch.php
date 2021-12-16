<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory,Language;

    protected $guarded=['id'];
    public $incrementing = false;


    
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'ahop_id', 'user_id');
    }
    public function language(){
        return $this->hasMany(BranchLang::class,'branch_id');
    }
    
    public function langs(){
        return $this->hasMany(BranchLang::class,'branch_id');
    }


}
