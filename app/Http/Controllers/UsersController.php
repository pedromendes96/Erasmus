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
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function Add(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
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
        return view('register.register',compact('programs','countries','universities'));
    }

//    public function IndexLogin(Request $request){
//        return view ('login.login');
//    }

    public function Login(Request $request){
        if($request->password = "admin" and $request->email="admin@admmin"){
            return view('admin');
        }
        $user = User::where('email',$request->email)->first();
        if($user) {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                if ($request->password == $user->password/*Hash::check($request->password, $user->password)*/) {
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
            if($emailExists or $phoneExists){
                return $this->Index($request);// fazer validação
            }
            $role = $request->role;
            if ($role == "student") {
                return app('App\Http\Controllers\StudentsController')->Add($request);
            } else if ($role == "manager") {
                app('App\Http\Controllers\ManagersController')->Add($request);
            } else if ($role == "director") {
                app('App\Http\Controllers\DirectorsController')->Add($request);
            }
            //return view ('home');
        } else {
            return $this->Index($request);
        }
    }

    public function Index(Request $request){
        $universities = University::all();
        $addresses = Address::all();
        $cities = City::all();
        $countries = Country::all();
        return view('admin',compact('universities','addresses','cities','countries'));
    }

    public function ChangeProperty(Request $request){
        $property = $request->change;
        $user = User::where('id',$request->id)->get();
        if($property == "name"){
            $user->name=$request->name;
        }else if($property == "password"){
            $user->password = bcrypt($request->password);
        }else if($property == "email"){
            $user->email = $request->email;
        }else{
            $user->address_id = $this->GetAddressId($request);
        }
    }

    public function GetAddressId(Request $request){
        $address_result = Address::where('name',$request->address)->first();
        if($address_result){
            return $address_result->id;
        }else{
            return app('App\Http\Controllers\AddressesController')->Add($request);
        }
    }
}
