<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function City(){
        return $this->hasMany('App\City');
    }

//    public static function GetById($id){
//        return \DB::table('countries')->where('id','=',$id)->get();
//    }
}
