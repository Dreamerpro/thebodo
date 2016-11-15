<?php
Route::group([
		'middleware'=>['web','auth','admin'],
		'prefix'=>'admin'
		], 
function ()
{
	Route::get('/', 'Admin\Home@index');
	Route::get('/home', 'Admin\Home@index');
	Route::get('/dictionary-translate', 'Admin\Dictionary@index');
});
