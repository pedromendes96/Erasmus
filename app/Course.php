<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function Program(){
        return $this->belongsToMany('App\Program');
    }
}
