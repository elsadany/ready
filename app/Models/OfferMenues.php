<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferMenues extends Model {

    protected $primaryKey = 'offer_id';
    protected $table = 'offer_menus';
    public $timestamps = false;

}
