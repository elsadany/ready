<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $appends=['typeName'];
    protected $hidden=['created_at','updated_at'];
            function getTypeNameAttribute(){
        if($this->type==0)
            return 'precent';
        else
            return 'fixed';
        
    }
    
}
