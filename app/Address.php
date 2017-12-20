<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function Person(){
        return $this->belongsTo('App\Person');
    }
    public function University(){
        return $this->belongsTo('App\University');
    }
    public function City(){
        return $this->belongsTo('App\City');
    }

//    public static function GetAddressById($id){
//        return \DB::table('address')->where('id', '=', $id)->get();
//    }
//
//    public static function RemoveAddressbyId($id){
//        \DB::table('address')->where('id', '=', $id)->delete();
//    }
}
