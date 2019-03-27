<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class VerificationCode extends Model
{

    protected $fillable = [
        'code',
        'member_id'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
