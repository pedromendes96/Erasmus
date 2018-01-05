<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function Person(){
        return $this->hasOne('App\Person');
    }
}
