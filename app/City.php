<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    public function scopeAllowedToSeeCities($query)
    {
        $user = Auth::user();
        if(!$user->hasRole('admin'))
            return $query->where('id', $user->city_id);

        return $query;
    }
}