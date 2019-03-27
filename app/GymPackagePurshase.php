<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymPackagePurshase extends Model
{
    protected $fillable = [
    
        'member_id',
        'package_id',
        'gym_id',
        'bought_price',
    ];
    public $timestamps = false;
}
