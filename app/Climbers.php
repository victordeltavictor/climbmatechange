<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Climbers extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'grade',
    ];
}
