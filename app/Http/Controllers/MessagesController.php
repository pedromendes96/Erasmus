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
        $id = session('id');
        $messages = Message::where('user_id',$id)->orderBy('created_at', 'desc')->get();
        $numberPags = ceil($messages->count()/5);
        $numberPags = $numberPags > 0 ? $numberPags : 1;
        $number = $messages->count()> 5 ? 5 : $messages->count();
        $pag = $request->pag;
        $users = User::all();
        return view('messages',compact('numberPags','pag','number','users'));
    }

    public function ReadMessage(Request $request){
        $message = Message::find($request->msg);
        $sender = User::find($message->sender_id);
        return view('message',compact('message','sender'));
    }

    public function NewMessage(Request $request){
        $role = session('role');
        $id = session('id');
        $user = User::find($id);
        if($role=="student"){
            $student = Student::where('id','=',$user->student_id)->first();
            $candidate = Candidate::find($student->id);
            $process = Process::where([['candidate_id','=',$candidate->id],['active','=','true']])->first();
            $manager = Manager::find($process->manager_id);
            $manager = User::find($manager->user_id);
            $program = Program::where('id','=',$student->program_id)->first();
            $director = Director::find($program->director_id);
            $director = User::find($director->user_id);
            return view('newMessage',compact('director','manager','role'));
        }elseif ($role == "manager"){
            $university = University::find($user->university_id);
            $programs = $university->Program();
            $manager = Manager::find($user->id);
            $processes = Process::where([['manager_id','=',$manager->id],['active','=','true']])->get();
            $studentsID = array();
            foreach ($processes as $process){
                array_push($studentsID,$process->student_id);
            }
            $candidates=array();
            for ($i=0;$i<count($studentsID);$i++){
                $user = User::find($studentsID[$i]);
                array_push($students,$user);
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
            return view('newMessage',compact('directors','candidates','role'));
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
                $processes = Process::where([['manager_id','=',$managers[$i]->id],['active','=','true']])->get();
                for ($i = 0;$i<count($processes);$i){
                    $candidate = Candidate::where('user_id','=',$processes[$i]->user_id)->get();
                    $user = User::find($candidate->user_id);
                    array_push($candidates,$user);
                }
            }
            return view('newMessage',compact('managers','candidates'));
        }
    }

    public function PrepareReplyMessage(Request $request){
        $message = Message::find($request->pag);
        $receiver = User::find($message->user_id);
        $subject = $message->subject;
        $action = "reply";
        return view('newMessage',compact('receiver','subject','action'));
    }

    public function SendMessage(Request $request){
        $message = new Message;
        $message->subject = $request->subject;
        $message->content = $request->answer;
        $message->sender_id = $request->sender;
        $message->user_id = $request->id;//session("id");
        $message->save();
        redirect('/Dashboard/messages/1');
    }
}
