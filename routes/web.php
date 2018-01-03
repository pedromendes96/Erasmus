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

//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', 'InformationsController@News' );

Route::get('/LogIn', function () {
    return view('LogIn');
});

Route::get('/Dashboard', function () {
    return view('Dashboard');
});

Route::get('/teste','MessagesController@NewMessage');

Route::post('/LogIn', 'UsersController@Login');

Route::get('/information', 'UniversitiesController@Index');

Route::get('/register', 'UsersController@IndexRegister');

Route::post('/register','UsersController@Register');

Route::get('/resetpassword', 'UsersController@ResetPasswordIndex');

Route::post('/resetpassword', 'UsersController@ResetPassword');

Route::get('/news/{info}','InformationsController@SelectedNew');

Route::get('/universitiesC', 'UniversitiesController@SelectedbyCountry');

Route::get('/programs', 'ProgramsController@SelectedbyUniversity');

Route::get('/dashboard/message/{msg}', 'MessagesController@ReadMessage');

Route::get('/dashboard/messages/{pag}', 'MessagesController@Index');

Route::get('/dashboard/Newmessages/', 'MessagesController@NewMessage');

Route::get('/dashboard/replymessage/{msg}', 'MessagesController@PrepareReplyMessage');

Route::post('/dashboard/Newmessages/', 'MessagesController@SendMessage');

Route::get('/dashboard/settings', 'UsersController@UserProfileIndex');

Route::post('/dashboard/settings', 'UsersController@UserProfileEditAction');

Route::get('/dashboard/settings/edit', 'UsersController@EditUserInfoIndex');

Route::post('/dashboard/settings/edit', 'UsersController@EditUserInfo');

Route::get('/cities','CitiesController@Index');

Route::get('/universities','UniversitiesController@Selected');

Route::get('/radiouniversities', 'UniversitiesController@SelectedRadio');

Route::get('/university/{id}','UniversitiesController@Show');

Route::get('/admin','UsersController@Admin');

Route::post('/admin','UsersController@AdminAction');

Route::get('/dashboard', 'DashboardController@index');

Route::post('/dashboard/newProcess', 'DashboardController@createProcess');

Route::get('/dashboard/process', 'DashboardController@showProcesses');

Route::get('/dashboard/process/{id}', 'DashboardController@showProcess');

Route::post('/dashboard/process/approve', 'ProcessesController@approveResult');

Route::post('/dashboard/process/upload', 'DashboardController@updateFiles');

Route::get('/test', 'DashboardController@test');
