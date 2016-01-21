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

	Route::group(['prefix' => 'team'], function () {
		// TEAM MANAGEMENT BASED ON TEAM
		Route::get('/create', 'TeamController@create');
		Route::post('/store', 'TeamController@store');
		Route::get('/{slug}/edit', 'TeamController@edit');
		Route::post('/{slug}/update', 'TeamController@update');
		Route::get('/{slug}/delete', 'TeamController@delete');

		// FEED MANAGEMENT BASED ON TEAM
		Route::get('/{slug}/feed', 'FeedController@index');
		Route::get('/{slug}/feed/create', 'FeedController@create');
		Route::post('/{slug}/feed/store/', 'FeedController@store');
		Route::get('/{slug}/feed/edit/{id}', 'FeedController@edit');
		Route::post('/{slug}/feed/update/{id}', 'FeedController@update');
		Route::get('/{slug}/feed/delete/{id}', 'FeedController@delete');

		// TAG MANAGEMENT BASED ON FEED
		Route::get('/{slug}/feed/{id}', 'TagController@index');
	});

});
