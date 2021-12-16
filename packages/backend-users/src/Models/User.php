<?php

namespace ElsayedNofal\BackendUsers\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    protected $table='backend_users';
    protected $fillable=['name','email','image'];
    
    function role(){
        if(class_exists('\Elsayednofal\BackendRoles\Models\Roles')){
            return $this->hasOne('Elsayednofal\BackendRoles\Models\UsersRoles','user_id');
        }
    }
}