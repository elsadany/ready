<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OffersNotification extends Model
{
    use Language;
       
        protected $hidden=['created_at','updated_at'];
                function langs(){
        return $this->hasMany(OffersNotificationLang::class,'offers_notification_id');
    }
    function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
   
}
