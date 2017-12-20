<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessesController extends Controller
{
    //
    public function Add(Request $request){
        $process = new Process;
        $process->description = $request->description;
        $process->active = 1;
        $process->candidate_id = $request->candidate_id;
        $process->manager_id = $request->manager_id;
        $process->save();
        /*
         *
         */DB::table('process_university')->insert(
            [
                'process_id' => $process->id,
                'university_id' => Manager::find($process->manager_id)->university_id,
                'result' => 0
            ]);

        return $process->id;
    }

    public function Remove(Request $request){
        Process::where('id',$request->id).delete();
    }

    public function Index(){
        return DB::table('processes')->select('manager_id',DB::raw('count(*) as numProcess'))
            ->groupBy('manager_id')->orderByRaw('numProcess ASC')->get();
        return $process->first()->manager_id;
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $process = Process::where('id',$request->id).get();
        if($property == "name"){
            $process->name=$request->name;
        }else{
            $process->active = $request->active;
        }
    }
}
