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

Route::get('/home', 'HomeController@index');
Route::get('/dictionary', 'Web\Dictionary@index');
Route::get('/dictionary/about', 'Web\Dictionary@about');

@include('admin.php');
@include('superadmin.php');
// Route::get('/admins', 'AdminController@index');
Route::get('/test',  function (\Illuminate\Http\Request $req)
{
	return view('test.index');
});
