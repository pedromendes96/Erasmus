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

    public function Director(){
        return $this->belongsTo('App\Director');
    }

//    public static function GetById($id){
//        return \DB::table('users')->where('id', '=', $id)->get();
//    }
//
//    public static function RemoveById($id){
//        \DB::table('users')->where('id','=',$id)->delete();
//    }
}
