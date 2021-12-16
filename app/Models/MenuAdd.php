<?php

namespace App\Models;

use App\Models\Language;
use App\Models\MenuAddLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuAdd extends Model
{
    use HasFactory,Language;

    protected $guarded=['id'];

    
    public function langs()
    {
        return $this->hasMany(MenuAddLang::class, 'add_id');
    }
    
}
