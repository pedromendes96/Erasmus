<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function Address(){
        return $this->hasOne('App\Address');
    }

    public function Student(){
        return $this->hasMany('App\Student');
    }

    public function Manager(){
        return $this->hasMany('App\Manager');
    }

    public function Process(){
        return $this->belongsToMany('App\Process');
    }

    public function Program(){
        return $this->belongsToMany('App\Program');
    }
}
