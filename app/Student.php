<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function User(){
        return $this->hasOne('App\User');
    }
    public function Candidate(){
        return $this->belongsTo('App\Student');
    }

    public function Program(){
        return $this->hasOne('App\Program');
    }

//    public static function RemoveById($id){
//        \DB::table('students')->where('id', '=', $id)->delete();
//    }
}
