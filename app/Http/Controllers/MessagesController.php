<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Director;
use App\Manager;
use App\Message;
use App\Process;
use App\Program;
use App\Student;
use App\University;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function Index(Request $request){
        if (session('userID') == "admin") {
            return redirect('/admin');
        }
        $id = session('userID');
        $result = session('result');
        $messages = Message::where('user_id', $id)->orWhere('sender_id', $id)->orderBy('updated_at', 'desc')->get();
        $numberPags = ceil($messages->count()/5);
        $numberPags = $numberPags > 0 ? $numberPags : 1;
        $pag = $request->pag;
        $users = User::all();
        $number = $messages->count() - ($pag - 1) * 5;
        $number = $number > 5 ? 5 : $number;
        $id = (string)$id;
        return view('messages', compact('numberPags', 'pag', 'number', 'users', 'messages', 'id', 'result'));
    }

    public function ReadMessage(Request $request){
        if (session('userID') == "admin") {
            return redirect('/admin');
        }
        $msg = $request->msg;
        $id = session('userID');
        $message = Message::find($request->msg);
        $sender = User::find($message->sender_id);
        return view('message', compact('message', 'sender', 'msg', 'id'));
    }

    public function NewMessage(Request $request){
        if (session('userID') == "admin") {
            return redirect('/admin');
        }
        $number = null;
        $director = null;
        $role = session('role');
        $id = session('userID');
        $user = User::find($id);
        $action = "new";
        if($role=="student"){
            $student = Student::where('user_id', '=', $user->id)->first();
            $candidate = Candidate::where('student_id', '=', $student->id)->first();
            $processes = Process::where('candidate_id', '=', $candidate->id)->orderBy('created_at', 'desc')->get();
            $managers = [];
            foreach ($processes as $process) {
                $manager = Manager::find($process->manager_id);
                $manager = User::find($manager->user_id);
                $aux = false;
                foreach ($managers as $temp) {
                    if ($temp->id == $manager->id) {
                        $aux = true;
                    }
                }
                if (!$aux) {
                    array_push($managers, $manager);
                }
            }
            $program = Program::where('id','=',$student->program_id)->first();
            $director = Director::where('program_id', '=', $program->id)->first();
            $director = User::find($director->user_id);
            $number = count($managers);
            return view('newMessage', compact('director', 'managers', 'role', 'action', 'number'));
        }elseif ($role == "manager"){
            $university = University::find($user->university_id);
            $programs = $university->Program();

            $manager = Manager::where('user_id', $user->id)->first();
            $processes = Process::where('manager_id', '=', $manager->id)->get();
            $studentsID = array();
            // PROBLEMA QUE ISTO DEVOLVE UM CANDIDATO, NAO EXISTE STUDENT.
            foreach ($processes as $process){
                array_push($studentsID, $process);
            }
            return dd($studentsID);
            $candidates=array();
            for ($i=0;$i<count($studentsID);$i++){
                $user = User::find($studentsID[$i]);
                array_push($candidates, $user);
            }
            $directorsID = array();
            foreach ($programs as $program){
                array_push($directorsID,$program->director_id);
            }
            $directors = array();
            for ($i=0;$i<count($directorsID);$i++){
                $user = User::find($directorsID[$i]);
                array_push($directors,$user);
            }
            return view('newMessage', compact('directors', 'candidates', 'role', 'action', 'number', 'director'));
        }else{
            $university = University::find($user->university_id);
            $users = User::where('university_id','=',$university->id)->get();
            $managers = array();
            foreach ($users as $user){
                $manager = Manager::where('user_id','=',$user->id)->get();
                if($manager){
                    array_push($managers,$manager);
                }
            }
            $candidates = array();
            for ($i=0;$i<count($managers);$i++){
                $processes = Process::where('manager_id', '=', $managers[$i]->id)->get();
                for ($i = 0;$i<count($processes);$i){
                    $candidate = Candidate::where('user_id','=',$processes[$i]->user_id)->get();
                    $user = User::find($candidate->user_id);
                    $aux = false;
                    foreach ($candidates as $c) {
                        if ($c->id == $user->id) {
                            $aux = true;
                        }
                    }
                    if (!$aux) {
                        array_push($candidates, $user);
                    }
                }
            }
            return view('newMessage', compact('managers', 'candidates', 'action'));
        }
    }

    public function PrepareReplyMessage(Request $request){
        if (session('userID') == "admin") {
            return redirect('/admin');
        }
        $message = Message::find($request->msg);
        $receiver = User::find($message->user_id);
        $subject = $message->subject;
        $action = "reply";
        return view('newMessage',compact('receiver','subject','action'));
    }

    public function SendMessage(Request $request){
        if (session('userID') == "admin") {
            return redirect('/admin');
        }
        $message = new Message;
        $message->subject = $request->subject;
        $message->content = $request->answer;
        $message->sender_id = session("userID");
        $message->user_id = $request->sender;
        $message->save();
        $result = "success";
        return redirect('/dashboard/messages/1')->with('result', $result);
    }
}
