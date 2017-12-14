<?php

namespace App\Http\Controllers;

use App\Director;
use Illuminate\Http\Request;

class DirectorsController extends Controller
{
    //
    public function Add(Request $request){
        $director = new Director;
        $director->user_id = app('App\Http\Controllers\UsersController')->Add();
        $director->program_id = $request->program_id;
        $director->save();
        return $director->id;
    }

    public function Remove(Request $request){
        Director::where('id',$request->id).delete();
    }

    public function Index(Request $request){

    }
}
