<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use App\Country;
use App\University;
use App\Program;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function Add(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = $request->remember_token;
        //Temos de verificar se N endereco existe se nao criar , caso contrario usar esse
        $user->address_id = $this->GetAddressId($request);
        $user->save();
        return $user->id;
    }


    public function Remove(Request $request){
        User::where('id',$request->id).delete();
    }

    public function Index(Request $request){
        $countries = Country::all();
        $universities = University::all();
        $programs = Program::all();
        return view('register.register',compact('programs','countries','universities'));
    }

    public function verifyRole(Request $request){
        $role = $request->role;
        if ($role == "student") {
            app('App\Http\Controllers\StudentsController')->Add($request);
        }
        else if ($role =="manager") {
            app('App\Http\Controllers\ManagersController')->Add($request);
        }
        else if ($role =="director"){
            app('App\Http\Controllers\DirectorsController')->Add($request);
        }
        return view ('home');
        #return vista
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $user = User::where('id',$request->id)->get();
        if($property == "name"){
            $user->name=$request->name;
        }else if($property == "password"){
            $user->password = bcrypt($request->password);
        }else if($property == "email"){
            $user->email = $request->email;
        }else{
            $user->address_id = $this->GetAddressId($request);
        }
    }

    public function GetAddressId(Request $request){

        $address_result = Address::where('name',$request->address)->get();
        if($address_result-> count() > 0){
            return $address_result[0]->id;
        }else{
            return app('App\Http\Controllers\AddressesController')->Add($request);
        }
    }
}
