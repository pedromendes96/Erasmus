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
//    return view('welcome');
    return "Ola David";
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/insertCountry', 'CountriesController@Add');

Route::get('/insertCity','CitiesController@Add');

Route::get('/insertCourse','CoursesController@Add');

Route::get('/removeCourse','CoursesController@Remove');

Route::get('/register/','UsersController@Index');

Route::post('/register/','UsersController@verifyRole');
?>