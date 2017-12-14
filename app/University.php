<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function Address(){
        return $this->hasOne('App\Address');
    }

    public function Student(){
        return $this->hasMany('App\Student');
    }

    public function Manager(){
        return $this->hasMany('App\Manager');
    }

    public function Process(){
        return $this->belongsToMany('App\Process');
    }

    public function Program(){
        return $this->belongsToMany('App\Program');
    }

//    public static function GetById($id){
//        return \DB::table('universities')->where('id', '=', $id)->get();
//    }
//
//    public static function RemoveById($id){
//        \DB::table('universities')->where('id', '=', $id)->delete();
//    }
}
