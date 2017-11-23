<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function Student(){
        return $this->hasOne('App\Student');
    }

    public function Process(){
        return $this->hasMany('App\Process');
    }
}
