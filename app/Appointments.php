<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'time',
        'day',
    ];

    public function climber(){
        return $this->belongsTo("App\Climbers");
    }
    public function location(){
        return $this->belongsTo("App\Locations");
    }
}
