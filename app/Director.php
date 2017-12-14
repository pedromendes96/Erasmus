<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public function Person(){
        return $this->hasOne('App\Person');
    }

    public function Program(){
        return $this->belongsTo('App\Program');
    }

//    public static function RemoveById($id){
//        \DB::table('directors')->where('id', '=', $id)->delete();
//    }
}
