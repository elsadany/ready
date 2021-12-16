<?php

namespace App\Models;

trait Language{


    function lang($type='first'){
        switch ($type) {
            case 'defualt':
                return $this->langs()->where('lang_id',1)->first();
                break;
            case 'first':
                return $this->langs()->first();
                break;
            case is_numeric($type):
                return $this->langs()->where('lang_id',$type)->first();
                break;   
            default:
                return $this->langs()->first();
                break;
        }
    }

}