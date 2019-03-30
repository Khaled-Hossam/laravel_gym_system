<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableContract
{
    use Notifiable;
    use HasRoles;
    use Bannable;
    
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'national_id', 'avatar','city_id','gym_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAllowedToSeeGymManagers($query)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return $query;
        }
        // return all users in the same city without the city manager himself
        if ($user->hasRole('city_manager')) {
            return $query->where('city_id', $user->city_id)->where('id', '!=', $user->id);
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
