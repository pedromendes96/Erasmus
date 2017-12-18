<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function Person(){
        return $this->belongsTo('App\Person');
    }
    public function University(){
        return $this->belongsTo('App\University');
    }
    public function City(){
        return $this->belongsTo('App\City');
    }
}
