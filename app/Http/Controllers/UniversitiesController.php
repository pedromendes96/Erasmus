<?php

namespace App\Http\Controllers;

use App\Address;
use App\University;
use Illuminate\Http\Request;

class UniversitiesController extends Controller
{
    public function Add(Request $request){
        $university = new University;
        $university->name = $request->name;
        $university->description = $request->description;
        $university->email = $request->email;
        $university->address_id = $this->GetAddressId($request);
        $university->save();
        return $university->id;
    }

    public function Remove(Request $request){
        University::where('id',$request->id).delete();
    }

    public function Index(Request $request){

    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $university = University::where('id',$request->id).get();
        if($property == "name"){
            $university->name=$request->name;
        }else if($property == "description"){
            $university->description = $request->description;
        }else if($property == "email"){
            $university->email = $request->email;
        }else{
            $university->address_id = $this->GetAddressId($request);
        }
    }

    private function GetAddressId(Request $request){
        if($address_reference = Address::where('id',$request->id).get()){
            return $address_reference->id;
        }else{
            return app('App\Http\Controllers\AddressController')->Add($request);
        }
    }

    public function Selected(Request $request){
        $city = City::where('id',$request->city)->first();
        $addresses = Address::where('city_id',$city->id)->get();
        $universities = [];
        foreach ($addresses as $address){
            $uni = University::where('address_id',$address->id)->get();
            if($uni){
                array_push($universities,$uni);
            }
        }
        return view('Universities',compact('universities'));
    }
}
