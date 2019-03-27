<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany('App\Package','gym_package_purshases');;
    }
}
