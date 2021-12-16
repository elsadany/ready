<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $appends = ['user'];

    function getUserAttribute(){
        $user= User::find($this->user_id);
        if(is_object($user))
            $user->full_name;
        return '';
    }
                function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

}
