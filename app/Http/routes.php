<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Routes that can be accessed by either logged-in or logged-out users

Route::group(['middleware' => ['web']], function () {

});

// Routes that can only be accessed by logged-out users

Route::group(['middleware' => ['web', 'guest']], function () {

	Route::get('/login', 'Auth\AuthController@showLogin');
	Route::post('/login', 'Auth\AuthController@login');

	Route::get('/register', 'Auth\AuthController@showRegister');
	Route::post('/register', 'Auth\AuthController@register');

});

// Routes that can only be accessed by logged-in users

Route::group(['middleware' => ['web', 'auth']], function () {

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/logout', 'Auth\AuthController@logout');

	// Student data routes

	Route::group(['prefix' => 'studentdata'], function () {
		Route::get('', 'StudentData@index');
		//Route::get('/{nim}', 'StudentData@show');
		//Route::get('/{nim}/edit', 'StudentData@edit');
		//Route::put('/{nim}', 'StudentData@update');
	});

	// Profile picture routes

	/*Route::group(['prefix' => 'profilepictures'], function () {
		Route::get('/{nim}', 'ProfilePicture@show');
		Route::get('/{nim}/edit', 'ProfilePicture@edit');
		Route::put('/{nim}', 'ProfilePicture@update');
	});
	*/
});

/* RESTful routes

	Route::get('/', 'index');
	Route::get('/new', 'new');
	Route::post('/', 'create');
	Route::get('/{nim}', 'show');
	Route::get('/{nim}/edit', 'edit');
	Route::put('/{nim}', 'update');
	Route::delete('/{nim}', 'destroy');

*/