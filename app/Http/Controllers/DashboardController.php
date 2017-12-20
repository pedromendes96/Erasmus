<?php

namespace App\Http\Controllers;

use App\Director;
use App\Manager;
use App\Process;
use App\Student;
use App\University;
use Illuminate\Http\Request;
use App\User;
use App\Candidate;
use App\Managers;
use PhpParser\Node\Scalar\MagicConst\Dir;


class DashboardController extends Controller
{
    public function index() {

        //get user via session
        $user = 'student';//example to continue code

        if($user == 'student') {
            //The button "create new process" only appears if the last process created was done more than 6months ago OR if all processes are inactive.
            //show his processes
            //my settings
            //my messages(inside has messages and chat)
            return view('dashboard.indexStudent');
        }
        else if($user == 'manager') {
            //show all processes from his university
            //my settings
            //my messages(inside has only messages)
            return view('dashboard.indexManager');
        }
        else if($user == 'director') {
            //show all processes from his program course(Students needs program on database to know how to choose director)
            //my settings
            //my messages(inside has only messages)
            return view('dashboard.indexDirector');
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }


    public function createProcess(Request $request) {
        //$candidate = createCandidate($request);
        $user=session('user');

        $student = Student::where('user_id',$user->id);
        $candidate = Candidate::where('student_id',$student->id);
        //add student id to request
        if($candidate == null){
            app('App\Http\Controllers\CandidatesController')->Add($request);
        }
        else {
            return $candidate;
        }
        //Add on request the candidate id
            $processCand = $request->candidate_id;
            $processCand = $candidate->id;
        //Add on request the manager id
            $processManager = $request->manager_id;
                $allManager = $process = DB::table('processes')
                    ->select('manager_id',DB::raw('count(*) as numProcess'))
                    ->groupBy('manager_id')
                    ->orderByRaw('numProcess ASC')
                    ->get();
            $processManager = $allManager->first()->manager_id;
        $process = app('App\Http\Controllers\ProcessController')->Add($request);
        $process = Process::find($process);
        //create process_university table
        //DB::table('process_university')->insert();

        return view( bladeblcvtbryntgrvf,compact('user','candidate','process'));
    }

    public function showProcesses() {
        $user = 'student';//TEST

        $student = Student::where('user_id',$user->id)->first();
        $manager = Manager::where('user_id',$user->id)->first();
        $director = Director::where('user_id',$user->id)->first();
        $candidate = Candidate::where('student_id',$student->id)->first();
        if($user == 'student') {
            //show his processes
            $processes = Process::where('candidate_id',$candidate->id)->get();
            return view('dashboard.showProcesses', compact('user','processes'));
        }
        else if($user == 'manager') {
            //show all processes from his university
            $processes = Process::where('university_id',$manager->university_id)->get();
            return view('dashboard.showProcesses', compact('user','processes'));
        }
        else if($user == 'director') {
            //show all processes only from his university and from his program course(Students needs program on database to know how to choose director)
            //Student has program!!!! DATABASE
            //Find all process of the students that have the same program as the director
            $processes = Process::where('university_id',$director->university_id)->get();
                //where director->program_id == student->program_id
            return view('dashboard.showProcesses', compact('user','processes'));
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }

    public function showProcess($id) {
        $user = 'student';

        if($user == 'student') {
            //show his processes
            return view('dashboard.showProcess');
        }
        else if($user == 'manager') {
            //show all processes from his university
        }
        else if($user == 'director') {
            //show all processes only from his university and from his program course(Students needs program on database to know how to choose director)
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }

    public function showSettings() {
        $user = 'student';

        if($user == 'student') {
            return view('dashboard.showSettings');
        }
        else if($user == 'manager') {
        }
        else if($user == 'director') {
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }


}
