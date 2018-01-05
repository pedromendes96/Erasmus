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
            $programs = $university->Program;

            $director = [];

            foreach ($programs as $program){
                $directors = Director::where('program_id', $program->id)->first();
                $directors = User::where('id', $directors->user_id)->first();
                array_push($director, $directors);
            }
            //tenho os diretores agora preciso dos candidatos
            $manager = Manager::where('user_id', $id)->first();
            $processes = Process::where('manager_id', $manager->id)->get();
            $candidates = [];
            foreach ($processes as $process) {
                $aux = false;
                $candidate = Candidate::find($process->candidate_id);
                $student = Student::find($candidate->student_id);
                $user = User::find($student->user_id);
                if (sizeof($candidates) == 0) {
                    array_push($candidates, $user);
                } else {
                    foreach ($candidates as $cand) {
                        if ($cand->id == $user->id) {
                            $aux = true;
                        }
                    }
                    if ($aux) {
                        array_push($candidates, $user);
                    }
                }
            }
            return view('newMessage', compact('directors', 'candidates', 'role', 'action', 'number', 'director'));
        }else{
            $university = University::find($user->university_id);
            $users = User::where('university_id','=',$university->id)->get();
            $managers = array();
            foreach ($users as $user){
                $manager = Manager::where('user_id', $user->id)->get();
                return dd($manager);
                $user = User::find($manager->user_id);
                if($manager){
                    array_push($managers, $user);
                }
            }
            $candidates = [];
            for ($i=0;$i<count($managers);$i++){
                $candidates = [];
                $processes = Process::where('manager_id', $managers[$i]->id)->get();
                foreach ($processes as $process) {
                    $aux = false;
                    $candidate = Candidate::find($process->candidate_id);
                    $student = Student::find($candidate->student_id);
                    $user = User::find($student->user_id);
                    if (sizeof($candidates) == 0) {
                        array_push($candidates, $user);
                    } else {
                        foreach ($candidates as $cand) {
                            if ($cand->id == $user->id) {
                                $aux = true;
                            }
                        }
                        if ($aux) {
                            array_push($candidates, $user);
                        }
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
