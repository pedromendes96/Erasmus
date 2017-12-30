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
use Illuminate\Support\Facades\Storage;


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
    return "done";
    }

    public function index(Request $request) {

        //$request->session()->flush();

        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.
        $user->role = session('role');//Don't change. it uses this variable name in index.
        $active = false;//If true, the user is a student and can create a new process. If not, the user is a manager or a director.

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
                            $active = false;//candidate exists and student has an active process.

                        }
                        else {
                            $active = true;//candidate exists and student doesn't have an active process.
                        }
                    }
                    else {
                        $active = true;//There are no processes in general created
                    }
                }
                else{
                    $active = true;//candidate doesn't exists
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
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.

        $student = Student::where('user_id',$user->id)->first();
        $candidate = Candidate::where('student_id',$student->id)->first();
        if($candidate == null){
            $candidate  = app('App\Http\Controllers\CandidatesController')->Add($student->id);
            $candidate = Candidate::where('student_id',$student->id)->first();
        }

        $allUsersFromUniversity = User::where('university_id',$user->university_id)->get();
        $managers = [];
        $y=0;
        for($i=0;$i<$allUsersFromUniversity->count();$i++) {
            if(Manager::where('user_id',$allUsersFromUniversity[$i]->id)->first()) {
                $managers[$y] = Manager::where('user_id',$allUsersFromUniversity[$i]->id)->first();
                $y++;
            }
        }
        $assignedManagerId = '';
        for ($i = 0; $i < count($managers);$i++ ){
            if(!$assignedManagerId){
                $assignedManagerId = $managers[$i]->id;
            }
            else{
                if(Process::where('manager_id',$assignedManagerId)->count() > Process::where('manager_id',$managers[$i]->id)->count()){
                    $assignedManagerId=$managers[$i]->id;
                }
            }
        }
            $request->candidate_id = $candidate->id;
            $request->manager_id = $assignedManagerId;
            $request->description = $request->semester." Semester - ".University::find($request->university)->name." - ".Country::find($request->country)->name;
            $request->university_id = $request->university;//UNIVERSIDADE DE DESTINO
            $process = app('App\Http\Controllers\ProcessesController')->Add($request);
        //return "Process created. Redirect to view";
        return redirect('/dashboard');
    }

    public function showProcesses() {
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.
        $user->role = session('role');//Don't change. it uses this variable name in index.

        if($user->role == 'student') {
            //show only his processes
            //$processes = DB::table('processes')->orderBy('updated_at', 'desc')->get();
            if(!$student = Student::where('user_id',$user->id)->first()){
                return "Cannot find student with current user id.";
            }
            if(!$candidate = Candidate::where('student_id',$student->id)->first()){
                return "Cannot find candidate with current user id.";
            }
            if(!$processes = Process::where('candidate_id',$candidate->id)->orderBy('active', 'desc')->first()) {
                return "You don't have any processes yet. Create a new process";
            }
            $processes = Process::where('candidate_id',$candidate->id)->orderBy('active', 'desc')->get();
            $university = University::find($student->id)->first();
            //return view('dashboard.showProcesses',compact('processes'));
            return view('Process.showProcesses', compact('user','processes','university'));
        }
        else if($user->role == 'manager') {
            //show all processes from his university that was assigned to this manager.
            $manager = Manager::where('user_id',$user->id)->first();
            if(!$processes = Process::where('manager_id',$manager->id)->first()) {
                return "You don't have any processes assigned to you yet";
            }
            $processes = Process::where('manager_id',$manager->id)->orderBy('active', 'desc')->get();
            return view('Process.showProcesses', compact('user','processes'));
        }
        else if($user->role == 'director') {
            //show all processes from his university with his program course.
            //Student has program!!!! DATABASE
            //Find all process of the students that have the same program as the director
            //$processes = Process::where('university_id',$director->university_id)->get();
            //$program = $director->program_id;
            //join user
            ////where director->program_id == student->program_id
            $allUsersFromUniversity = User::where('university_id',$user->university_id)->get();
            $managers = [];
            $y=0;
            for($i=0;$i<$allUsersFromUniversity->count();$i++) {
                if(Manager::where('user_id',$allUsersFromUniversity[$i]->id)->first()) {
                    $managers[$y] = Manager::where('user_id',$allUsersFromUniversity[$i]->id)->first();
                    $y++;
                }
            }

            $processes = Process::whereIn('manager_id', [1, 2])->get();
            return $processes;
            return view('Process.showProcesses', compact('user','processes'));
            return "There's no role in this user or other problem.";
        }
        else{
            return "Maybe there's no processes on this user.";
        }
    }

    public function showProcess(Request $request) {
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.
        $user->role = session('role');//Don't change. it uses this variable name in index.

        $getURL = $request->url();
        $countEndURL = strrpos($getURL,"/")+1;
        $getEndURL = substr($getURL,$countEndURL);
        $processId = decrypt($getEndURL);

        if($user->role == 'student') {
            //show his processes
            $process = Process::find($processId);
            $manager =  User::find( Manager::find($process->manager_id)->user_id );
            return view('Process.showProcess',compact('user','process','manager'));
        }
        else if($user->role == 'manager') {
            //show all processes from his university
            $process = Process::find($processId);
            $manager =  $user;//Since the user is the manager and will only see his processes! Just to leave compact() function identical below.
            return view('Process.showProcess',compact('user','process','manager',''));
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

    public function updateFiles(Request $request) {
        return "update Files.";
    }
}
