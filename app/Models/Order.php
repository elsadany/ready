<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $casts=[
        'address_data'=>'object'
    ];
    
    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
    function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    function getStatusnameAttribute(){
        if(array_key_exists($this->tracking_status, status))
                return status[$this->tracking_status];
        return '';
    }
    function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
