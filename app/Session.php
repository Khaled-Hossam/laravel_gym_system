<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

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
    protected $fillable = ['name', 'starts_at', 'finishes_at', 'gym_id'];
    public $timestamps = false;	
    protected $dates = ['finishes_at','starts_at'];
    public function gym()
    {
        return $this->belongsTo('App\Gym');
    }

    public function coaches()
    {
        return $this->belongsToMany('App\Coach','coaches_sessions');;
    }
    public function member()
    {
        return $this->belongsToMany('App\Attendance');
    }
    
}
