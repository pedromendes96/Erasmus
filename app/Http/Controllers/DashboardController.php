<?php

namespace App\Http\Controllers;

use App\Country;
use App\Director;
use App\Manager;
use App\Process;
use App\Processes;
use App\Student;
use App\University;
use Illuminate\Http\Request;
use App\User;
use App\Candidate;
use App\Managers;
use App\City;



class DashboardController extends Controller
{

    public function test() {//Esta função é so para testar pequenos codigos para verificar se funcionam individualmente.
        //Choose which university that he wants to go.
        //Tell user that it's better to ask the manager the available options for erasmus on his university on his program.
        //$processes = Process::all()->orderByRaw('updated_at DESC')->get();
        //$processes = Process::all()->orderBy('updated_at', 'ASC');
/*
        $getURL = $request->url();
        $countEndURL = strrpos($getURL,"/")+1;
        $getEndURL = substr($getURL,$countEndURL);
        return decrypt($getEndURL);
*/
    }

    public function index() {
        //get user via session
        $user = User::find(1);
        $user->role = 'student';//example to continue code
        $active = false;//If true, the user is student and can create a new process. If not, user is manager or director.

        if($user->role == 'student') {
            //The button "create new process" only appears if the last process created was done more than 6months ago OR if all processes are inactive.
            //show his processes
            //my settings
            //my messages(inside has messages and chat)
            $countries = Country::all();
            $universities = University::all();
            $cities = City::all();
            $student = Student::where('user_id',$user->id)->first();
            $candidate = Candidate::where('student_id',$student->id)->first();
                if($candidate){//if candidate exists
                    $process = Process::where('candidate_id',$candidate->id)->orderBy('active', 'desc')->first();
                    if($process){//if process exists
                        if($process->active == 1){
                            $active = false;
                        }
                        else {
                            $active = true;
                        }
                    }
                    else {
                        $active = true;
                    }
                }
                else{
                    $active = true;
                }
            return view('dashboard.index',compact('user','countries','universities','cities','active'));
        }
        else if($user->role == 'manager') {
            return view('dashboard.index',compact('user','active'));
        }
        else if($user->role == 'director') {
            return view('dashboard.index',compact('user','active'));
        }
        else {
            return "Something wrong with user's id or with the user's role. Or both.";
        }
    }

    public function createProcess(Request $request) {
        $user = User::find(1);
        $student = Student::where('user_id',$user->id)->first();
        $candidate = Candidate::where('student_id',$student->id)->first();
        if($candidate == null){
            $candidate  = app('App\Http\Controllers\CandidatesController')->Add($student->id);
            $candidate = Candidate::where('student_id',$student->id)->first();
        }
        $managers = Manager::where('university_id',$student->university_id)->get();
        $assignedManagerId = "";
        for ($i = 0; $i < $managers->count();$i++ ){
            $managersId[$i]= $managers[$i]->id;
            $managersProcess[$i] = $managerProcesses = Process::where('manager_id',$managers[$i]->id)->count();
            if(!$assignedManagerId){
                $assignedManagerId = $managers[$i]->id;
            }
            else{
                if(Process::where('manager_id',$assignedManagerId)->count() < Process::where('manager_id',$managers[$i]->id)->count()){
                    $assignedManagerId=$managers[$i]->id;
                }
            }
        }
            $request->candidate_id = $candidate->id;
            $request->manager_id = $assignedManagerId;
            $request->description = $request->semester." - ".University::find($request->university)->name." - ".Country::find($request->country)->name;
            $request->university_id = $request->university;//UNIVERSIDADE DE DESTINO
            $process = app('App\Http\Controllers\ProcessesController')->Add($request);
    }

    public function showProcesses() {
        $user = User::find(1);
        $user->role = 'student';
    /*
        $student = Student::where('user_id',$user->id)->first();
        $manager = Manager::where('user_id',$user->id)->first();
        $director = Director::where('user_id',$user->id)->first();
        $candidate = Candidate::where('student_id',$student->id)->first();
    */
        if($user->role == 'student') {
            //show only his processes
            //$processes = DB::table('processes')->orderBy('updated_at', 'desc')->get();
            $student = Student::where('user_id',$user->id)->first();
            $candidate = Candidate::where('student_id',$student->id)->first();
            $university = University::find($student->id)->first();
            $processes = Process::where('candidate_id',$candidate->id)->orderBy('updated_at', 'desc')->get();
            //return view('dashboard.showProcesses',compact('processes'));
            return view('Process.showProcesses', compact('user','processes','university'));
        }
        else if($user->role == 'manager') {
            //show all processes from his university
            //$processes = Process::where('university_id',$manager->university_id)->get();
            $processes = Process::all();
            return view('Process.showProcesses', compact('user','processes'));
        }
        else if($user->role == 'director') {
            //show all processes only from his university and from his program course(Students needs program on database to know how to choose director)
            //Student has program!!!! DATABASE
            //Find all process of the students that have the same program as the director
            //$processes = Process::where('university_id',$director->university_id)->get();
            //$program = $director->program_id;
            //join user
                //where director->program_id == student->program_id
            $processes = Process::all();
            return view('Process.showProcesses', compact('user','processes'));
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }

    public function showProcess(Request $request) {
        $user = User::find(1);
        $user->role = 'student';

        $getURL = $request->url();
        $countEndURL = strrpos($getURL,"/")+1;
        $getEndURL = substr($getURL,$countEndURL);
        $processId = decrypt($getEndURL);

        if($user->role == 'student') {
            //show his processes
            $process = Process::find($processId);
            $manager =  User::find(Manager::find($process->manager_id)->user_id)->name;
            return view('Process.showProcess',compact('user','process','manager'));
        }
        else if($user->role == 'manager') {
            //show all processes from his university
            $process = Process::find($processId);
            $manager =  User::find(Manager::find($process->manager_id)->user_id)->name;
            return view('Process.showProcess',compact('user','process','manager'));
        }
        else if($user->role == 'director') {
            //show all processes only from his university and from his program course(Students needs program on database to know how to choose director)
            $process = Process::find($processId);
            $manager =  User::find(Manager::find($process->manager_id)->user_id)->name;
            return view('Process.showProcess',compact('user','process','manager'));
        }
        else {
            return "There's no role in this user or other problem.";
        }
    }

}
