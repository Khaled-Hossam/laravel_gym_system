<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function member()
    {
        // return $this->belongsTo('App\User');
        return $this->belongsTo(Member::class);
    }
    public function session()
    {
        // return $this->belongsTo('App\User');
        return $this->belongsTo(Session::class);
    }
    protected $fillable = [
        'member_id', 'session_id','attended_at'
    ];

    public function scopeAllowedToSeeAttendances($query)
    {
        
        if (Auth::user()->hasRole('city_manager')) {
            return $query->where('city_id', Auth::user()->city_id);
        }
        
        if (Auth::user()->hasRole('gym_manager')) {
            return $query->where('gym_id', Auth::user()->gym_id);
        }

        return $query;
    }
}
