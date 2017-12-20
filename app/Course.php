<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function Program(){
        return $this->belongsToMany('App\Program');
    }

//    public static function RemoveById($id){
//        \DB::table('courses')->where('id', '=', $id)->delete();
//    }
//
//    public static function GetById($id){
//        return \DB::table('courses')->where('id', '=', $id)->get();
//    }
}
