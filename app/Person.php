<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function Address(){
        return $this->hasOne('App\Address');
    }

    public function Manager(){
        return $this->belongsTo('App\Manager');
    }

    public function Student(){
        return $this->belongsTo('App\Student');
    }

    public function Director(){
        return $this->belongsTo('App\Director');
    }
}
