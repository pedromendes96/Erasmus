<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function Add($student_id){
        $candidate = new Candidate;
        $candidate->student_id = $student_id;
        $candidate->save();
        return $candidate->id;
    }

    public function RemoveById(Request $request){
        Candidate::where('id',$request->id)->delete();
    }

    public function Index(Request $request){
    }
}
