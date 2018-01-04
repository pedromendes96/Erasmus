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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        if (session('userID')) {
            return redirect('/');
        } else {
            $countries = Country::all();
            $universities = University::all();
            $programs = Program::all();
            return view('register', compact('programs', 'countries', 'universities'));
        }
    }

    public function IndexLogin(Request $request)
    {
        if (session('userID')) {
            return redirect('/');
        } else {
            return view('LogIn');
        }
    }

    public function Admin(Request $request){
        if (session('userID') == 'admin') {
            $universities = University::all();
            $addresses = Address::all();
            $cities = City::all();
            $countries = Country::all();
            $news = Information::all();
            return view('admin', compact('universities', 'addresses', 'cities', 'countries', 'news'));
        }
        return redirect('/');
    }

    public function Login(Request $request){
        $user = User::where('email', $request->email)->first();
        if($request->password == "admin" and $request->email=="admin@admin"){
            session(['userID' => 'admin']);
            return redirect('admin');
        }
        if($user) {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                if (Hash::check($request->password, $user->password)) {
                    session(['userID' => $user->id]);
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
                    session(['userID' => $user->id]);
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
                    session(['userID' => $user->id]);
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

    public function Logout(Request $request)
    {
        $request->session()->forget('userID');
        return redirect('/');

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
            if ($emailExists) {
                return redirect('/register')->with('emailExists', $emailExists);
            }
            if ($phoneExists) {
                return redirect('/register')->with('phoneExists', $phoneExists);
            }
            $role = $request->role;
            if ($role == "student") {
                app('App\Http\Controllers\StudentsController')->Add($request);
            } else if ($role == "manager") {
                app('App\Http\Controllers\ManagersController')->Add($request);
            } else {
                app('App\Http\Controllers\DirectorsController')->Add($request);
            }
            $user = User::where('email', $request->email)->first();
            session(['userID' => $user->id]);
            session(['role' => $role]);
            return redirect('/dashboard');
        } else {
            $pwNotMatch = True;
            return redirect('/register')->with('pwNotMatch', $pwNotMatch);
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
                if ($request->x == "" or $request->x == "") {
                    // nada
                } else {
                    $university->lat = $request->x;
                    $university->long = $request->y;
                }
                $university->img = $array[1];
                $university->address_id = $request->address;
                $university->save();
            } elseif ($request->type == "program") {
                $program = Program::where('name', $request->name)->first();
                if (!$program) {
                    $program = new Program;
                    $program->name = $request->name;
                    $program->description = $request->description;
                    $program->save();
                }
                $university = $request->university;
                DB::table('program_university')->insert(
                    ['program_id' => $program->id, 'university_id' => $university, 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()]
                );
            } else {
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
                $item = University::find($request->universities);
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
                } elseif ($request->column == "address") {
                    $item->address_id = $request->address;
                } else if ($request->column == "x") {
                    $item->lat = $request->x;
                } else {
                    $item->long = $request->y;
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

    public function EditUserInfo(Request $request)
    {
        $user = User::find(session('userID'));

        if ($request->name != "") {
            $user->name = $request->name;
        }
        if ($request->password != "") {
            if ($request->password == $request->confirmpassword) {
                $user->password = bcrypt($request->password);
            } else {
                $pwNotMatch = True;
                return redirect('/dashboard/userprofile/edit')->with('pwNotMatch', $pwNotMatch);
            }
        }
        if ($request->email != "") {
            if (User::where('email', $request->email)->first()) {
                $emailExists = True;
                return redirect('/dashboard/userprofile/edit')->with('emailExists', $emailExists);
            } else {
                $user->email = $request->email;
            }
        }
        if ($request->phone != "") {
            if (User::where('phone', $request->phone)->first()) {
                $phoneExists = True;
                return redirect('/dashboard/userprofile/edit')->with('phoneExists', $phoneExists);
            } else {
                $user->phone = $request->phone;
            }
        }
        if ($request->image != "") {
            $dir = 'public/img/user';
            if (Storage::disk('local')->exists($dir)) {
            } else {
                Storage::makeDirectory($dir);
            }
            $file = $request->file('image');
            $type = "/image/";
            if (preg_match($type, $file->getMimeType())) {
                $path = $file->store($dir);
                $array = explode('/', $path, 2);
                $user->img = $array[1];
            } else {
                $notImg = True;
                return redirect('/dashboard/userprofile/edit')->with('notImg', $notImg);
            }
        }
        if ($request->address == "" and $request->city != "") {
            $cityb4addr = True;
            return redirect('/dashboard/userprofile/edit')->with('cityb4addr', $cityb4addr);
        } else if (($request->address != "" and $request->city != "") or ($request->address != "" and $request->city == "")) {
            $user->address_id = $this->GetAddressId($request);
        }

        $user->save();
        return redirect('/dashboard/settings');
    }

    public function ResetPasswordIndex()
    {
        if (session('userID')) {
            return redirect('/');
        } else {
            return view('resetpassword');
        }
    }

    public function ResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($request->password == $request->confirmpassword) {

                $user = User::find($user->id);
                $user->password = bcrypt($request->password);
                $user->save();
            } else {
                $pwNotMatch = True;
                return redirect('/resetpassword')->with('pwNotMatch', $pwNotMatch);
            }
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                session(['role' => "student"]);
            } else {
                $manager = Manager::where('user_id', $user->id)->first();
                if ($manager) {
                    session(['role' => "manager"]);
                } else {
                    session(['role' => "director"]);
                }
            }
            session(['userID' => $user->id]);
            return redirect('/dashboard'); //falta role
        } else {
            $userNotExists = True;
            return redirect('/resetpassword')->with('userNotExists', $userNotExists);
        }

    }

    public function getUserInformation($userid)
    {
        $user = User::where('id', $userid)->first();
        $user->address = Address::where('id', $user->address_id)->first();
        $user->city = City::where('id', $user->address->city_id)->first();
        $user->country = Country::where('id', $user->city->country_id)->first();
        $user->university = University::where('id', $user->university_id)->first();
        return $user;
    }

    public function EditUserInfoIndex()
    {
        //adicionar edição de foto
        $userid = session('userID');
        $role = session('role');
        $user = $this->getUserInformation($userid);
        $user->role = $role;
        $countries = Country::all();
        if ($role == 'student') {
            return view('editprofile', compact('user', 'countries'));
        }
        if ($role == 'manager') {
            return view('editprofile', compact('user', 'countries'));
        } else if ($role = 'director') {
            return view('editprofile', compact('user', 'countries'));
        }
    }

    public function UserProfileIndex(Request $request)
    {
        $userid = session('userID');
        $role = session('role');
        $user = $this->getUserInformation($userid);
        $user->role = $role;
        if ($role == 'student') {
            $student = Student::where('user_id', $user->id)->first();
            $user->program = Program::where('id', $student->program_id)->first();
        }
        if ($role == 'manager') {

        }
        if ($role == 'director') {
            $director = Director::where('user_id', $user->id)->first();
            $user->program = Program::where('id', $director->program_id)->first();

        }
        return view('userprofile', compact('user'));

    }

    public function UserProfileEditAction(Request $request)
    {
        return redirect('/dashboard/settings/edit');
    }
}
