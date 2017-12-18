<?php

namespace App\Http\Controllers;

use App\Student;
use App\Country;
use App\University;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function Add(Request $request){
        $student = new Student;
        $student->university_id = $request->university_id;
        $student->user_id = app('App\Http\Controllers\UsersController')->Add($request);
        $student->save();
        return $student->id;
    }

    public function Remove(Request $request){
        Student::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
        $countries = Country::all();
        $universities = University::all();
        return view('register.registerStudent', compact('countries'),compact('universities'));//,compact('universities'));
    }
}
