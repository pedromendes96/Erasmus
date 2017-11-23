<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Country(){
        return $this->belongsTo('App\Country');
    }

    public function Address(){
        return $this->hasMany('App\Address');
    }
}
