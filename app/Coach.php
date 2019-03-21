<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $table = 'coaches';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    
}
