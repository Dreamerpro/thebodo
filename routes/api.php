<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::group(['middleware'=>['web','auth']], function ()
{
	Route::post('/admin/word/save','\App\Http\Controllers\Admin\Dictionary@save') ;
	Route::post('/get/getdictionary','\App\Http\Controllers\Admin\Dictionary@getdictionary') ;
	Route::post('/dictionary/search','\App\Http\Controllers\Admin\Dictionary@search') ;
});

Route::group(['middleware'=>['web']], function ()
{
	Route::get('/history/all','HistoryController@getall');
	Route::post('/history/create','HistoryController@saveEvent');
	Route::post('/history/update','HistoryController@updateEvent');
	Route::post('/history/delete','HistoryController@deleteEvent');
});
