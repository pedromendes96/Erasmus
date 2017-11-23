<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function City(){
        return $this->hasMany('App\City');
    }
}
