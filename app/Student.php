<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function Person(){
        return $this->hasOne('App\Person');
    }
    public function Candidate(){
        return $this->belongsTo('App\Student');
    }
    public function University(){
        return $this->belongsTo('App/University');
    }

//    public static function RemoveById($id){
//        \DB::table('students')->where('id', '=', $id)->delete();
//    }
}
