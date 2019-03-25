<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends  Authenticatable implements JWTSubject
{

    use Notifiable;

    protected $table = 'members';
    protected $member;

    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'gender', 'national_id', 'avatar'
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
    public function __construct()
    {
        // $this->member = JWTAuth::parseToken()->authenticate();
    }
}
