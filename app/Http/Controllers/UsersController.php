<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\University;
use App\Program;
use App\Student;
use App\User;
use App\Manager;
use App\Director;
use App\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    public function Add(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->university_id = $request->university_id;
        //Temos de verificar se N endereco existe se nao criar , caso contrario usar esse
        $user->address_id = $this->GetAddressId($request);
        $user->save();
        return $user->id;
    }

    public function Remove(Request $request){
        User::where('id',$request->id)->delete();
    }

    public function IndexRegister(Request $request){
        $countries = Country::all();
        $universities = University::all();
        $programs = Program::all();
        return view('register',compact('programs','countries','universities'));
    }

//    public function IndexLogin(Request $request){
//        return view ('login.login');
//    }

    public function Login(Request $request){
        if($request->password == "admin" and $request->email=="admin@admmin"){
            return view('admin');
        }
        $user = User::where('email',$request->email)->first();
        if($user) {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                if ($request->password == Hash::check($request->password, $user->password)) {
                    $user->role = 'student';
                    return view('Dashboard',compact('user'));
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
//                    return view('LogIn',compact('incorrect'));
                }
            }
            $manager = Manager::where('user_id', $user->id)->first();
            if ($manager) {
                if (Hash::check($request->password, $user->password)) {
                    $user->role = 'manager';
                    return view('Dashboard',compact('user'));
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
//                    return view('LogIn',compact('incorrect'));
                }
            }
            $director = Director::where('user_id', $user->id)->first();
            if ($director) {
                if (Hash::check($request->password, $user->password)) {
                    $user->role = 'director';
                    return view('Dashboard',compact('user'));
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
//                    return view('LogIn',compact('incorrect'));
                }
            }
        } else {
            $noexistence = true;
            return back()->with('noexistence',$noexistence);
//            return view('LogIn',compact('noexistence'));
        }
    }

    public function IndexDashboard(){
        $user=session('user');
        //$user=User::where('id',session('id'))->first();
        return view('dashboard',compact('user'));
    }

    public function Register(Request $request){
        $password = $request->password;
        $confpassword = $request->confirmpassword;
        $emailExists=User::where('email', $request->email)->first();
        $phoneExists=User::where('phone',$request->phone)->first();
        if ($password == $confpassword) {
            if($emailExists ){
               return redirect ('/register')->with('emailExists',$emailExists);
            }
            if ($phoneExists){
               return redirect ('/register')->with('phoneExists',$phoneExists);
            }
            $role = $request->role;
            if ($role == "student") {
                return app('App\Http\Controllers\StudentsController')->Add($request);
            } else if ($role == "manager") {
                return app('App\Http\Controllers\ManagersController')->Add($request);
            } else if ($role == "director") {
                return app('App\Http\Controllers\DirectorsController')->Add($request);
            }
        } else {
            $pwNotMatch = True;
            return redirect ('/register')->with('pwNotMatch',$pwNotMatch);
        }
    }

    public function IndexAdmin(Request $request){
        $universities = University::all();
        $addresses = Address::all();
        $cities = City::all();
        $countries = Country::all();
        return view('admin',compact('universities','addresses','cities','countries'));
    }

    public function EditUserInfo(Request $request){
        //n funciona mt bem na edição de addr e cidades que ja tenham sido inseridas
        $user = User::find($request->userid);

        if($request->name != ""){
            $user->name=$request->name;
        }
        if($request->password != ""){
            if($request->password == $request->confirmpassword) {
                $user->password = bcrypt($request->password);
            } else{
                $pwNotMatch =  True;
                return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role)->with('pwNotMatch',$pwNotMatch);
            }
        }
        if($request->email != ""){
            if(User::where('email',$request->email)->first())
            {
                $emailExists =  True;
                return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role)->with('emailExists',$emailExists);
            }
            else {
                $user->email = $request->email;
            }
        }
        if ($request->phone != ""){
            if (User::where('phone',$request->phone)->first())
            { $phoneExists =  True;
                return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role)->with('phoneExists',$phoneExists);
            }else {
                $user->phone = $request->phone;
            }
        }
        if ($request->image != ""){
            $dir='public/img/user';
            if (Storage::disk('local')->exists($dir)){
            }
            else {
                Storage::makeDirectory($dir);
            }
            $file=$request->file('image');
            $type = "/image/";
            if(preg_match($type,$file->getMimeType())) {
                $path = $file->store($dir);
                $array = explode('/', $path, 2);
                $user->img = $array[1];
            } else {
                $notImg =  True;
                return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role)->with('notImg',$notImg);
            }
        }
        if($request->address == "" and $request->city != ""){
           $cityb4addr = True;
            return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role)->with('cityb4addr',$cityb4addr);
        } else if (($request->address != "" and $request->city != "") or ($request->address != "" and $request->city == "")) {
            $user->address_id = $this->GetAddressId($request);
        }

        $user->save();
        return redirect('/dashboard/userprofile')->with('userid',$request->userid)->with('role',$request->role);
    }
    public function ResetPasswordIndex(){
        return view ('resetpassword');
    }
    public function ResetPassword(Request $request){
        $user = User::where('email',$request->email)->first();
        if ($user) {
            if ($request->password == $request->confirmpassword) {

                $user = User::find($user->id);
                $user->password = bcrypt($request->password);
                $user->save();
            } else {
                $pwNotMatch = True;
                return redirect('/resetpassword')->with('pwNotMatch',$pwNotMatch);
            }
        } else {
            $userNotExists = True;
            return redirect('/resetpassword')->with('userNotExists',$userNotExists);
        }

        return redirect('/dashboard')->with('userid',$user->id); //falta role

    }

    public function GetAddressId(Request $request)
    {
            $address_result = Address::where('name', $request->address)->first();
            if ($address_result) {
                return $address_result->id;
            } else {
                return app('App\Http\Controllers\AddressesController')->Add($request);
            }
    }
    public function getUserInformation($userid){
        $user = User::where('id',$userid)->first();
        $user->address = Address::where('id',$user->address_id)->first();
        $user->city = City::where('id',$user->address->city_id)->first();
        $user->country = Country::where('id',$user->city->country_id)->first();
        $user->university = University::where('id',$user->university_id)->first();
        return $user;
    }

    public function EditUserInfoIndex(){
        //adicionar edição de foto
        $userid=session('userid');
        $role = session('role');
        $user = $this->getUserInformation($userid);
        $user->role = $role;
        $countries= Country::all();
        if ($role == 'student'){
            return view ('editprofile',compact('user','countries'));
        }
        if ($role == 'manager'){
            return view ('editprofile',compact('user','countries'));
        }

        else if ($role = 'director'){
            return view('editprofile',compact('user','countries'));
        }
    }

    public function UserProfileIndex(Request $request){
        $userid = session('userid');
        $role = session('role');
        $user=$this->getUserInformation($userid);
        $user->role = $role;
        if($role=='student'){
            $student = Student::where('user_id',$user->id)->first();
            $user->program = Program::where('id',$student->program_id)->first();
        }
        if($role=='manager'){

        }
        if($role=='director'){
            $director = Director::where('user_id',$user->id)->first();
            $user->program = Program::where('id',$director->program_id)->first();

        }
        return view('userprofile',compact('user'));

    }


    public function UserProfileEditAction(Request $request){
        return redirect('/dashboard/userprofile/edit')->with('userid',$request->userid)->with('role',$request->role);
    }
}
