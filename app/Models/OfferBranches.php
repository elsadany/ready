<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferBranches extends Model
{
    protected $primaryKey ='offer_id';
    protected $table='offer_branches';
    public $timestamps=false;
}
