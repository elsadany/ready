<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopsTag extends Model
{
    public $timestamps=false;
    
    public function tag()
    {
        return $this->belongsTo(GeneralTag::class, 'general_tag_id');
    }
}
