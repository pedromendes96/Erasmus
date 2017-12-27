<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\University;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Psy\Util\Json;
use Illuminate\Support\Str;

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
        University::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
        $countries = Country::all();
        return view('Information',compact('countries'));
    }

    public function Selected(Request $request){
        $city = City::where('id',$request->city)->first();
        $addresses = Address::where('city_id',$city->id)->get();
//        return dd($addresses);
        $universities = [];
        foreach ($addresses as $address){
            $uni = University::where('address_id',$address->id)->get();
            if($uni){
                array_push($universities,$uni);
//                $universities->put($uni);
            }
        }

//        return dd($universities);
        return view('Universities',compact('universities'));
    }

    public function SelectedbyCountry(Request $request){
        $country = Country::where('id',$request->country)->first();
        $cities = City::where('country_id',$country->id)->get();
        $universities = [];
        foreach ($cities as $city){
            $addresses = Address::where('city_id',$city->id)->get();
            foreach($addresses as $address){
                $university = University::where('address_id',$address->id)->get();
                if($university->isEmpty()) {

                } else {
                    array_push($universities,$university);
                }
            }

        }

        return view('universitiesbycountry',compact('universities'));
    }

    public function Show(Request $request){
        $university = University::where('id',$request->id)->first();
        return view('University',compact('university'));
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $university = University::where('id',$request->id)->get();
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
        if($address_reference = Address::where('id',$request->id)->get()){
            return $address_reference->id;
        }else{
            return app('App\Http\Controllers\AddressController')->Add($request);
        }
    }
}
