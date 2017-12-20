<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function Director(){
        $this->hasOne('App\Director');
    }
    public function University(){
        return $this->belongsToMany('App\University');
    }
    public function Course(){
        return $this->belongsToMany('App\Course');
    }

    public function Student(){
        return $this->belongsToMany('App\Student');
    }
}
