<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Gym extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gyms';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cover_image', 'city_id', 'creator_id'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function creator()
    {
        return $this->belongsTo('App\User');
    }
    
    public function GymPackagePurshases()
    {
        return $this->belongsToMany('App\Package', 'gym_package_purshases');
        ;
    }

    public function scopeAllowedToSeeGyms($query)
    {
        $user = Auth::user();
        if ($user->hasRole('city_manager')) {
            return $query->where('city_id', $user->city_id);
        }

        return $query;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }
    
}
