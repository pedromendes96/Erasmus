<?php

namespace App\Http\Controllers;

use App\Program;
use App\University;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function Add(Request $request){
        $program = new Program;
        $program->name = $request->name;
        $program->description = $request->description;
        $program->save();
        return $program->id;
    }

    public function Remove(Request $request){
        Program::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $program = Program::where('id',$request->id)->get();
        if($property == "name"){
            $program->name=$request->name;
        }else{
            $program->description = $request->description;
        }
    }

    public function SelectedbyUniversity(Request $request)
    {
        $university = University::where('id', $request->university)->first();
        $programs = $university->Program()->get();
        return view('programs', compact('programs'));
    }
}
