<?php
namespace App\Models;

class Settings extends Base\BaseModel
{
    protected $table = 'settings';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'key'=>'required|size:255',
        'value'=>'required',
        'type'=>'required|integer',
    ];
}