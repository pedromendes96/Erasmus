<?php

namespace App\Http\Controllers;

use App\Process;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function Add(Request $request){
        $process = new Process;
        $process->description = $request->description;
        $process->active = 1;
        $process->candidate_id = $request->candidate_id;
        $process->manager_id = $request->manager_id;
        $process->save();
        return $process->id;
    }

    public function Remove(Request $request){
        Process::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $process = Process::where('id',$request->id)->get();
        if($property == "name"){
            $process->name=$request->name;
        }else{
            $process->active = $request->active;
        }
    }
}
