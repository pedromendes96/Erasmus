<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
    public function Message(){
        return $this->belongsTo('App\Message');
    }
    public function Director(){
        return $this->belongsTo('App\Director');
    }

    public function University(){
        return $this->belongsTo('App/University');
    }
}
