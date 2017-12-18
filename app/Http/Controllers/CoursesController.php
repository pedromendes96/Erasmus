<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function Add(Request $request){
        $course = new Course;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        return $course->id;
    }

    public function Remove(Request $request){
        Course::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $course = Course::where('id',$request->id)->get();
        if($property == "name"){
            $course->name=$request->name;
        }else{
            $course->descriprion = $request->description;
        }
    }
}
