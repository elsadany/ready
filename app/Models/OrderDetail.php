<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
        protected $casts=['addes_id'=>'array'];

    function menu(){
        return $this->belongsTo(Menu::class,'menu_id');
    }
    function choose(){
        return $this->belongsTo(MenuChoose::class,'choose_id');
    }
    function getAddsAttribute(){
$names='';
$lang_id=1;
if(session('lang_id')!='')
    $lang_id=session('lang_id');
if($this->addes_id){
        $names= MenuAddLang::whereIn('add_id', $this->addes_id)->where('lang_id',$lang_id)->pluck('name')->toArray();
        return implode(',', $names);
}
return $names;
    }
}
