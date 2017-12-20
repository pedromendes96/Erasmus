<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function Person(){
        return $this->hasOne('App\Person');
    }

    public function Process(){
        return $this->hasMany('App\Process');
    }

//    public static function RemoveById($id){
//        \DB::table('managers')->where('id', '=', $id)->delete();
//    }
}
