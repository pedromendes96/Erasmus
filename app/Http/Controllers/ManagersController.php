<?php

namespace App\Http\Controllers;

use App\Manager;
use Illuminate\Http\Request;

class ManagersController extends Controller
{
    //
    public function Add(Request $request){
        $manager = new Manager;
        $manager->user_id = app('App\Http\Controllers\UsersController')->Add();
        $manager->university_id = $request->university_id;
        $manager->save();
        return $manager->id;
    }

    public function Remove(Request $request){
        Manager::where('id',$request->id).delete();
    }

    public function Index(Request $request){

    }
}
