<?php

namespace App\Models;

use App\Models\Cart;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory;
    protected $guarded=['password'];
    protected $appends=['imagePath'];
    protected $hidden=['password','parent','created_at','updated_at','mail_confirmed'];

    function getImagePathAttribute() {
        if ($this->image != '') {
            if (strpos($this->image, "http") !== false)
                return $this->image;
            else if (strstr($this->image,'uploads'))
                return url($this->image);
            
        }
        return 'https://www.w3schools.com/howto/img_avatar.png';
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }
    
}
