<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    public function Candidate(){
        return $this->belongsTo('App\Candidate');
    }
    public function Manager(){
        return $this->belongsTo('App\Manager');
    }
    public function University(){
        return $this->belongsToMany('App\University');
    }

//    public static function RemoveById($id){
//        \DB::table('processes')->where('id', '=', $id)->delete();
//    }
//
//    public static function GetById($id){
//        return \DB::table('processes')->where('id', '=', $id)->get();
//    }
}
