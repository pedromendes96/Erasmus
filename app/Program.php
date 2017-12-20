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

//    public static function RemoveById($id){
//        \DB::table('programs')->where('id', '=', $id)->delete();
//    }
//
//    public static function GetById($id){
//        return \DB::table('programs')->where('id', '=', $id)->get();
//    }
}
