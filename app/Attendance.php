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
}
