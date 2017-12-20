<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/newProcess', 'DashboardController@createProcess');
Route::get('/dashboard/process', 'DashboardController@showProcesses');
Route::get('/dashboard/process/{id}', 'DashboardController@showProcess');
Route::get('/dashboard/settings', 'DashboardController@showSettings');

Route::get('/create', 'ProcessesController@Add');
Route::get('/index', 'ProcessesController@Index');





