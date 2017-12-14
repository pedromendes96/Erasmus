<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Country(){
        return $this->belongsTo('App\Country');
    }

    public function Address(){
        return $this->hasMany('App\Address');
    }

//    public static function GetById($id){
//        return \DB::table('cities')->where('id','=',$id)->get();
//    }
//
//    public static function RemoveById($id){
//        \DB::table('cities')->where('id', '=', $id)->delete();
//    }
}
