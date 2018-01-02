<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/LogIn', function () {
    return view('LogIn');
});

Route::get('/Dashboard', function () {
    return view('Dashboard');
});

Route::post('/Dashboard', 'UsersController@Login');

Route::get('/Information', 'UniversitiesController@Index');


Route::get('/register', 'UsersController@IndexRegister');

Route::post('/register','UsersController@Register');

Route::get('/News', function () {
    return view('News');
});

Route::get('/cities','CitiesController@Index');

Route::get('/universities','UniversitiesController@Selected');

Route::get('/universitiesC','UniversitiesController@SelectedbyCountry');

Route::get('/programs','ProgramsController@SelectedbyUniversity');

Route::get('/university/{id}','UniversitiesController@Show');

Route::get('/admin','UsersController@IndexAdmin');

Route::get('/dashboard/userprofile/edit','UsersController@EditUserInfoIndex');
Route::post('/dashboard/userprofile/edit','UsersController@EditUserInfo');

Route::get('/resetpassword','UsersController@ResetPasswordIndex');
Route::post('/resetpassword','UsersController@ResetPassword');
Route::get('/teste',function(){return view('teste');});
Route::post('/teste',function(){
    return redirect('/dashboard/userprofile')->with('userid','2')->with('role','student');});

Route::get('/dashboard/userprofile','UsersController@UserProfileIndex');
Route::post('/dashboard/userprofile','UsersController@UserProfileEditAction');

Route::get('/uploadfiles',function(){return view('uploadfiles');});
Route::post('/uploadfiles','ProcessesController@uploadFiles');

Route::get('/downloadfiles','ProcessesController@downloadFile');