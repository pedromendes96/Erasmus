<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function Add(Request $request){
        $city = new City;
        $city->name = $request->city;
        $city->description = "unknown desc";#$request->description;
        //Se nao existir n pais , inserir
        $city->country_id = $this->GetCountryId($request);
        //$city->country_id = $request->country_id;
        $city->save();
        return $city->id;
    }

    public function Remove(Request $request){
        City::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
        $country = Country::where('name',$request->country)->first();
        $cities = City::where('country_id',$country->id)->get();
        return view('Cities',compact('cities'));
    }

    public function IndexR(Request $request)
    {
        $country = Country::where('name', $request->country)->first();
        $cities = City::where('country_id', $country->id)->get();
        return view('CitiesR', compact('cities'));
    }

    public function ChangeProperty(Request $request){
        $property = $request->property;
        $city = City::where('id',$request->id)->get();
        if($property == "name"){
            $city->name = $request->name;
        }else if($property == "description"){
            $city->description = $request->description;
        }else{
            $city->country_id = $this->GetCountryId($request);
        }
    }

    public function GetCountryId(Request $request){
        $country_result = Country::where('id',$request->country)->first();
        if($country_result){
            return $country_result->id;
        }else{
            return app('App\Http\Controllers\CountriesController')->Add($request);
        }
    }
}
