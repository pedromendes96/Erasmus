<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function Add(Request $request){
        #nunca chega aqui na edição de perfil nem no registo!!!
        $country = new Country;
        $country->name = $request->country;
        $country->description = "unknown desc"; #$request->description;
        $country->save();
        return $country->id;
    }

    public function Remove(Request $request){
        Country::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $country = Country::where('id',$request->id)->get();
        if($property == "name"){
            $country->name=$request->name;
        }else{
            $country->description = $request->description;
        }
    }
}
