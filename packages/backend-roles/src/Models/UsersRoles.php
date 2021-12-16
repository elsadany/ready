<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Elsayednofal\BackendRoles\Models;

/**
 * Description of UsersRoles
 *
 * @author Elsayed Nofal
 */
class UsersRoles extends Base\BaseModel {
    
    public $table='users_roles';
    protected $primaryKey='user_id';
    protected $guarded=[];
    
    public $rules=[
        'user_id'=>'required',
        'role_id'=>'required'
    ];
    
}
