<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public function User(){
        return $this->hasOne('App\User');
    }
    public function Program(){
        return $this->belongsTo('App\Program');
    }

//    public static function RemoveById($id){
//        \DB::table('directors')->where('id', '=', $id)->delete();
//    }
}
