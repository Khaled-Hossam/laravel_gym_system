<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JWTAuth;

class Member extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;

    protected $table = 'members';
    protected $member;

    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'gender', 'avatar',
        'verified', 'remaining_sessions', 'total_sessions'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function sessions()
    {
        // return $this->belongsToMany('sessions', 'attendance');
        // return $this->belongsToMany('App\Attendance');

    }
    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }
    
}
