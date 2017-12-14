<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use App\Country;
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

        return view('selectrole');

    }
    public function role(Request $request){
        #$countries = Country::all();
        $role = $request->role;
        if ($role == "student") {
            return redirect('/register/student/');
            //return view('registerstudent', compact('countries'));
        }

    }
    public function ChangeProperty(Request $request){
        $property = $request->change;
        $user = User::where('id',$request->id).get();
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
