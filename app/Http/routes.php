<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MarketingController@index');

Route::group(['middleware' => 'guest'], function() {
	Route::get('/login', 'UserController@login');
	Route::post('/login', 'UserController@authenticate');
	Route::get('/signup', 'UserController@signup');
	Route::post('/signup', 'UserController@store');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/logout', 'UserController@logout');

	Route::get('/dashboard', 'TeamController@index');
	Route::get('/teams/create', 'TeamController@create');
	Route::post('/teams/store', 'TeamController@store');
	Route::get('/teams/edit/{id}', 'TeamController@edit');
	Route::post('/teams/update/{id}', 'TeamController@update');

	Route::get('/feeds/{teamname}', 'FeedController@index');

	Route::get('/feeds/{teamname}/tags/{id}', 'TagController@index');
});
