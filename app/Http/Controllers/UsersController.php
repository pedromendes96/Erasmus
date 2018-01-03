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
use App\Information;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;

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

    public function Admin(Request $request){
        $universities = University::all();
        $addresses = Address::all();
        $cities = City::all();
        $countries = Country::all();
        $news = Information::all();
        return view('admin',compact('universities','addresses','cities','countries','news'));
    }

    public function Login(Request $request){
        if($request->password == "admin" and $request->email=="admin@admin"){
            return redirect('admin');
        }
        $user = User::where('email',$request->email)->first();
        session(['userID' => $user->id]);
        if($user) {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                if (Hash::check($request->password, $user->password)) {
                    session(['role' => "student"]);
                    return redirect('/dashboard');
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
                }
            }
            $manager = Manager::where('user_id', $user->id)->first();
            if ($manager) {
                if (Hash::check($request->password, $user->password)) {
                    session(['role' => "manager"]);
                    return redirect('/dashboard');
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
                }
            }
            $director = Director::where('user_id', $user->id)->first();
            if ($director) {
                if (Hash::check($request->password, $user->password)) {
                    session(['role' => "director"]);
                    return redirect('/dashboard');
                } else {
                    $incorrect = true;
                    return back()->with('incorrect',$incorrect);
                }
            }
        } else {
            $noexistence = true;
            return back()->with('noexistence',$noexistence);
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
                return dd('email ou telefone ja existe');// fazer validação
            }
            $role = $request->role;
            if ($role == "student") {
                app('App\Http\Controllers\StudentsController')->Add($request);
                return redirect('/LogIn');
            } else if ($role == "manager") {
                app('App\Http\Controllers\ManagersController')->Add($request);
                return redirect('/LogIn');
            } else if ($role == "director") {
                app('App\Http\Controllers\DirectorsController')->Add($request);
                return redirect('/LogIn');
            }
            //return view ('home');
        } else {
            return dd('nao foi inserido');
        }
    }

    public function IndexAdmin(Request $request){
        $universities = University::all();
        $addresses = Address::all();
        $cities = City::all();
        $countries = Country::all();
        $news = Information::all();
        return view('admin',compact('universities','addresses','cities','countries','news'));
    }

    public  function AdminAction(Request $request){
        if($request->operation == "add"){
            if($request->type == "country"){
                $country = new Country;
                $country->name = $request->name;
                $country->description = $request->description;
                $country->save();
            }elseif($request->type == "city"){
                $city = New City;
                $city->name = $request->name;
                $city->description = $request->description;
                $city->country_id = $request->country;
                $city->save();
            }elseif($request->type == "address"){
                $address = new Address;
                $address->name = $request->name;
                $address->city_id = $request->city;
                $address->save();
            }elseif($request->type == "university"){
                $university = new University;
                $university->name = $request->name;
                $university->description = $request->description;
                $university->email = $request->email;
                $path = $request->file('image')->store('public/img/university');
                $array = explode('/', $path, 2);
                $university->img = $array[1];
                $university->address_id = $request->address;
                $university->save();
            }else{
                $information = new Information;
                $information->title = $request->title;
                $information->description = $request->description;
                $information->content = $request->container;
                $path = $request->file('image')->store('public/img/new');
                $array = explode('/', $path, 2);
                $information->img = $array[1];
                $information->save();
            }
        }elseif($request->operation ="change"){
            if($request->type == "country"){
                $item = Country::find($request->country);
                if($request->column == "name"){
                    $item->name = $request->name;
                }elseif($request->column == "description"){
                    $item->description = $request->name;
                }
            }elseif($request->type == "city"){
                $item = City::find($request->city);
                if($request->column == "name"){
                    $item->name = $request->name;
                }else if($request->column == "description"){
                    $item->description = $request->name;
                }else{
                    $item->country_id = $request->country;
                }
            }elseif($request->type == "address"){
                $item = Address::find($request->address);
                if($request->column == "name"){
                    $item->name = $request->name;
                }else if($request->column == "city"){
                    $item->city_id = $request->city;
                }
            }elseif($request->type == "university"){
                $item = University::find($request->university);
                if($request->column == "name"){
                    $item->name = $request->name;
                }elseif($request->column == "description"){
                    $item->description = $request->description;
                }elseif ($request->column == "email"){
                    $item->email = $request->email;
                }elseif ($request->column == "image"){
                    $path = $request->file('image')->store('public/img/university');
                    $array = explode('/', $path, 2);
                    $item->img = $array[1];
                }else {
                    $item->address_id = $request->address;
                }
            }else{
                $item = Information::find($request->new);
                if($request->column == "title"){
                    $item->title = $request->title;
                }elseif($request->column == "description"){
                    $item->description = $request->description;
                }elseif($request->column == "content"){
                    $item->content = $request->container;
                }else{
                    $path = $request->file('image')->store('public/img/new');
                    $array = explode('/', $path, 2);
                    $item->img = $array[1];
                }
            }
            $item->save();
        }elseif($request->operation ="remove"){
            if($request->type == "country"){
                $item = Country::find($request->country);
            }elseif($request->type == "city"){
                $item = City::find($request->city);
            }elseif($request->type == "address"){
                $item = Address::find($request->address);
            }elseif($request->type == "university"){
                $item = University::find($request->university);
            }else{
                $item = Information::find($request->new);
            }
            $item->delete();
        }
        $universities = University::all();
        $addresses = Address::all();
        $cities = City::all();
        $countries = Country::all();
        $news = Information::all();
        return view('admin',compact('universities','addresses','cities','countries','news'));
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
