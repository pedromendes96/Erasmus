<?php

namespace App\Http\Controllers;

use App\Address;
use App\Country;
use App\Director;
use App\Manager;
use App\Process;
use App\Processes;
use App\Program;
use App\Student;
use App\University;
use Illuminate\Http\Request;
use App\User;
use App\Candidate;
use App\Managers;
use App\City;
use DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Symfony\Component\Translation\Dumper\PoFileDumper;


class DashboardController extends Controller
{

    public function test()
    {//Esta função é so para testar pequenos codigos para verificar se funcionam individualmente.
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

    public function index(Request $request)
    {

        //$request->session()->flush();
        $user = app('App\Http\Controllers\UsersController')->getUserInformation(session('userID'));
        $user->role = session('role');//Don't change. it uses this variable name in index.
        $active = false;//If true, the user is a student and can create a new process. If not, the user is a manager or a director.
        $process = null;
        if ($user->role == 'student') {
            //The button "create new process" only appears if the last process created was done more than 6months ago OR if all processes are inactive.
            //show his processes
            //my settings
            //my messages(inside has messages and chat)
            $countries = Country::all();
            $universities = University::all();
            $cities = City::all();
            $student = Student::where('user_id', $user->id)->first();
            $candidate = Candidate::where('student_id', $student->id)->first();

            if ($candidate) {//if candidate exists
                $process = Process::where('candidate_id', $candidate->id)->orderBy('active', 'desc')->first();
                if ($process) {//if process exists
                    if ($process->active == 1) {
                        $active = false;//candidate exists and student has an active process.

                    } else {
                        $active = true;//candidate exists and student doesn't have an active process.
                    }
                } else {
                    $active = true;//There are no processes in general created
                }
            } else {
                $active = true;//candidate doesn't exists
            }
            return view('dashboard.index', compact('user', 'countries', 'universities', 'cities', 'active', 'process'));
        } else if ($user->role == 'manager') {
            $manager = Manager::where('user_id', $user->id)->first();
            $process = Process::where('manager_id', $manager->id)->get();
            $process = $process->count();
            return view('dashboard.index', compact('user', 'active', 'process'));
        } else if ($user->role == 'director') {
            $directorProgramID = Director::where('user_id', $user->id)->first()->program_id;
            $getProcessesProgramID = DB::table('processes')
                ->join('candidates', 'candidates.id', '=', 'processes.candidate_id')
                ->join('students', 'students.id', '=', 'candidates.student_id')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->select('processes.id')
                ->where('students.program_id', $directorProgramID)
                ->get();
            $decodeProcesses = json_decode($getProcessesProgramID, true);
            $processes = Process::whereIn('id', $decodeProcesses)->orderBy('active', 'desc')->get();
            $process = $processes->count();
            return view('dashboard.index', compact('user', 'active', 'process'));
        } else {
            return "Something wrong with user's id or with the user's role. Or both.";
        }
    }

    public function createProcess(Request $request)
    {
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.

        $student = Student::where('user_id', $user->id)->first();
        $candidate = Candidate::where('student_id', $student->id)->first();
        if ($candidate == null) {
            $candidate = app('App\Http\Controllers\CandidatesController')->Add($student->id);
            $candidate = Candidate::where('student_id', $student->id)->first();
        }

        $allUsersFromUniversity = User::where('university_id', $user->university_id)->get();
        $managers = [];
        $y = 0;
        for ($i = 0; $i < $allUsersFromUniversity->count(); $i++) {
            if (Manager::where('user_id', $allUsersFromUniversity[$i]->id)->first()) {
                $managers[$y] = Manager::where('user_id', $allUsersFromUniversity[$i]->id)->first();
                $y++;
            }
        }
        $assignedManagerId = '';
        for ($i = 0; $i < count($managers); $i++) {
            if (!$assignedManagerId) {
                $assignedManagerId = $managers[$i]->id;
            } else {
                if (Process::where('manager_id', $assignedManagerId)->count() > Process::where('manager_id', $managers[$i]->id)->count()) {
                    $assignedManagerId = $managers[$i]->id;
                }
            }
        }
        $request->candidate_id = $candidate->id;
        $request->manager_id = $assignedManagerId;
        $request->description = $request->semester . " Semester - " . University::find($request->university)->name . " - " . $request->country;
        $request->university_id = $request->university;//GUARDA A UNIVERSIDADE DE DESTINO
        $process = app('App\Http\Controllers\ProcessesController')->Add($request);
        return redirect('/dashboard');
    }

    public function showProcesses()
    {
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.
        $user->role = session('role');//Don't change. it uses this variable name in index.
        $managers = null;
        $results = null;
        if ($user->role == 'student') {
            //show only his processes
            //$processes = DB::table('processes')->orderBy('updated_at', 'desc')->get();
            if (!$student = Student::where('user_id', $user->id)->first()) {
                return "Cannot find student with current user id.";
            }
            if (!$candidate = Candidate::where('student_id', $student->id)->first()) {
                return "Cannot find candidate with current user id.";
            }
            if (!$processes = Process::where('candidate_id', $candidate->id)->orderBy('active', 'desc')->first()) {
                return "You don't have any processes yet. Create a new process";
            }
            $processes = Process::where('candidate_id', $candidate->id)->orderBy('active', 'desc')->get();
            $university = University::find($user->id);
            $number = $processes->count();
            $pags = ceil($number / 10);
            $pags = $pags == 0 ? 1 : $pags;
            $candidatos = null;
            $managers = [];
            foreach ($processes as $process) {
                $manager = Manager::find($process->manager_id);
                $temp = User::find($manager->user_id);
                array_push($managers, $temp);
            }
            $results = [];
            foreach ($processes as $process) {
                $processUni = DB::table('process_university')->where('process_id', $process->id)->first();
                array_push($results, $processUni->result);
            }
            return view('Process.showProcesses', compact('user', 'processes', 'university', 'pags', 'candidatos', 'managers', 'results'));
        } else if ($user->role == 'manager') {
            //show all processes from his university that was assigned to this manager.
            $manager = Manager::where('user_id', $user->id)->first();
            if (!$processes = Process::where('manager_id', $manager->id)->first()) {
                return "You don't have any processes assigned to you yet";
            }
            $processes = Process::where('manager_id', $manager->id)->orderBy('active', 'desc')->get();
            $candidatos = [];
            foreach ($processes as $process) {
                $candidate = Candidate::find($process->candidate_id);
                $student = Student::find($candidate->student_id);
                $temp = User::find($student->user_id);
                array_push($candidatos, $temp);
            }
            $number = $processes->count();
            $pags = ceil($number / 10);
            $pags = $pags == 0 ? 1 : $pags;
            $results = [];
            foreach ($processes as $process) {
                $processUni = DB::table('process_university')->where('process_id', $process->id)->first();
                array_push($results, $processUni->result);
            }
            return view('Process.showProcesses', compact('user', 'processes', 'pags', 'candidatos', 'managers', 'results'));
        } else if ($user->role == 'director') {
            $directorProgramID = Director::where('user_id', $user->id)->first()->program_id;
            $getProcessesProgramID = DB::table('processes')
                ->join('candidates', 'candidates.id', '=', 'processes.candidate_id')
                ->join('students', 'students.id', '=', 'candidates.student_id')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->select('processes.id')
                ->where('students.program_id', $directorProgramID)
                ->get();
            $decodeProcesses = json_decode($getProcessesProgramID, true);
            $processes = Process::whereIn('id', $decodeProcesses)->orderBy('active', 'desc')->get();
            $candidatos = [];
            foreach ($processes as $process) {
                $candidate = Candidate::find($process->candidate_id);
                $student = Student::find($candidate->student_id);
                $temp = User::find($student->user_id);
                array_push($candidatos, $temp);
            }
            $number = $processes->count();
            $pags = ceil($number / 10);
            $pags = $pags == 0 ? 1 : $pags;
            $results = [];
            foreach ($processes as $process) {
                $processUni = DB::table('process_university')->where('process_id', $process->id)->first();
                array_push($results, $processUni->result);
            }
            return view('Process.showProcesses', compact('user', 'processes', 'pags', 'candidatos', 'managers', 'results'));
        } else {
            return "Maybe there's no processes on this user.";
        }
    }

    public function showProcess(Request $request)
    {
        $user = User::find(session('userID'));//Don't change. it uses this variable name in index.
        $user->role = session('role');//Don't change. it uses this variable name in index.
        $result = null;
        $getURL = $request->url();
        $countEndURL = strrpos($getURL, "/") + 1;
        $getEndURL = substr($getURL, $countEndURL);
        $processId = decrypt($getEndURL);

        if ($user->role == 'student') {
            //show his processes
            $process = Process::find($processId);
            $manager = User::find(Manager::find($process->manager_id)->user_id);
            $student = $user;

            $files = $process->file;
            $filesarr = explode('"-"', $files);
            $var = '/public\//';
            $files = array();
            foreach ($filesarr as $file) {
                if (preg_match($var, $file)) {
                    array_push($files, preg_replace($var, 'storage/', $file));
                }
            }
            sort($files);
            $address = Address::find($user->address_id);
            $city = City::find($address->city_id);
            $origin = Country::find($city->country_id)->name;

            $processUni = DB::table('process_university')->where('process_id', $process->id)->first();
            $university = University::find($processUni->university_id);
            $address = Address::find($university->address_id);
            $city = City::find($address->city_id);
            $destiny = Country::find($city->country_id)->name;
            $img = $user->img;
            $name = $user->name;

            $result = $processUni->result;

            return view('Process.showProcess', compact('user', 'process', 'manager', 'student', 'files', 'origin', 'destiny', 'img', 'name', 'result'));
        } else if ($user->role == 'manager') {
            //show all processes from his university
            $process = Process::find($processId);
            $manager = $user;//Since the user is the manager and will only see his processes! Just to leave compact() function identical below.
            $student = User::find(Student::find(Candidate::find($process->candidate_id)->student_id)->user_id);
            $studentUser = User::find(Student::find(Candidate::find($process->candidate_id)->student_id)->user_id);
            $files = $process->file;
            $filesarr = explode('"-"', $files);
            $var = '/public\//';
            $files = array();
            foreach ($filesarr as $file) {
                if (preg_match($var, $file)) {
                    array_push($files, preg_replace($var, 'storage/', $file));
                }
            }
            sort($files);

            return view('Process.showProcess', compact('user', 'process', 'manager', 'student', 'files', 'result'));
        } else if ($user->role == 'director') {
            //show all processes only from his university and from his program course(Students needs program on database to know how to choose director)
            $process = Process::find($processId);
            $manager = User::find(Manager::find($process->manager_id)->user_id);
            $student = User::find(Student::find(Candidate::find($process->candidate_id)->student_id)->user_id);
            $files = $process->file;
            $filesarr = explode('"-"', $files);
            $var = '/public\//';
            $files = array();
            foreach ($filesarr as $file) {
                if (preg_match($var, $file)) {
                    array_push($files, preg_replace($var, 'storage/', $file));
                }
            }
            sort($files);

            return view('Process.showProcess', compact('user', 'process', 'manager', 'student', 'files', 'result'));
        } else {
            return "There's no role in this user or other problem.";
        }
    }

    public function updateFiles(Request $request)
    {
        return "update Files.";
    }

    public function ProcessesDisplay(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->role = $request->role;
        $role = $user->role;
        $index = $request->index;
        if ($role == "student") {
            $entety = Student::where('user_id', $id)->first();
            $entety = Candidate::where('student_id', $entety->id)->first();
        } else if ($role == "manager") {
            $entety = Manager::where('user_id', $id)->first();
        } else {
            $entety = Director::where('user_id', $id)->first();
        }
        if ($entety) {
            if ($role == "student") {
                $processes = Process::where('candidate_id', $entety->id)->orderBy('active', 'desc')->get();
            } else if ($role == "manager") {
                $processes = Process::where('manager_id', $entety->id)->orderBy('active', 'desc')->get();
            } else {
                $directorProgramID = Director::where('user_id', $id)->first()->program_id;
                $getProcessesProgramID = DB::table('processes')
                    ->join('candidates', 'candidates.id', '=', 'processes.candidate_id')
                    ->join('students', 'students.id', '=', 'candidates.student_id')
                    ->join('users', 'users.id', '=', 'students.user_id')
                    ->select('processes.id')
                    ->where('students.program_id', $directorProgramID)
                    ->get();
                $decodeProcesses = json_decode($getProcessesProgramID, true);
                $processes = Process::whereIn('id', $decodeProcesses)->orderBy('active', 'desc')->get();
            }
            $number = $processes->count();
            $pags = ceil($number / 10);
            if ($pags < $index) {
                $index = $pags;
            }
            $pags = $pags == 0 ? 1 : $pags;
            $min = ($index - 1) * 10;
            if ($min + 10 > $number) {
                $max = $number;
            } else {
                $max = $min + 10;
            }
            $processes = Process::whereIn('id', $decodeProcesses)->orderBy('active', 'desc')->get();
            $candidatos = [];
            foreach ($processes as $process) {
                $candidate = Candidate::find($process->candidate_id);
                $student = Student::find($candidate->student_id);
                $temp = User::find($student->user_id);
                array_push($candidatos, $temp);
            }
            $results = [];
            foreach ($processes as $process) {
                $processUni = DB::table('process_university')->where('process_id', $process->id)->first();
                array_push($results, $processUni->result);
            }
            return view('Process.ajaxProcesses', compact('user', 'processes', 'min', 'max', 'index', 'role', 'candidatos', 'results'));
        }
        redirect('/dashboard');
    }
}
