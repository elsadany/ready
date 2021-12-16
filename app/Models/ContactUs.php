<?php
namespace App\Models;

class ContactUs extends Base\BaseModel
{
    protected $table = 'contact_us';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'name'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        'message'=>'required',
    ];
}