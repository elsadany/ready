<?php

namespace App\Models;

use App\Models\Language;
use App\Models\MenuChooseLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuChoose extends Model
{
    use HasFactory,Language;

    protected $guarded=['id'];
    
    public function langs(){
        return $this->hasMany(MenuChooseLang::class, 'choose_id');
    }
    
}
