<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
    
        'name',
        'country_id',
    ];
    public $timestamps = false;
    public function Country()
    {
        // return $this->belongsTo('App\User');
        return $this->belongsTo(Country::class);
    }
}
