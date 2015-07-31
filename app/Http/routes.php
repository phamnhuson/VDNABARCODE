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

Route::get('/', 'HomeController@index');


Route::get('login', ['uses' => 'Auth\AuthController@login', 'middleware' => ['guest']]);

Route::post('login', ['uses' => 'Auth\AuthController@authenticate', 'middleware' => ['guest']]);

Route::get('logout', ['uses' => 'Auth\AuthController@logout', 'middleware' => ['auth']]);

// Route::get('/admin', 'AdminController@index');

// Route::post('/admin', 'AdminController@index');

Route::get('/home', 'HomeController@index');

Route::resource('contact', 'ContactController');

Route::get('/report', 'ReportController@index');

Route::get('/user', ['as' => 'user', 'uses' => 'UserController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/user', ['uses' => 'UserController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/user', ['uses' => 'UserController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/city', ['uses' => 'CityController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/city', ['uses' => 'CityController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/city', ['uses' => 'CityController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/species', ['uses' => 'SpeciesController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/species', ['uses' => 'SpeciesController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/species', ['uses' => 'SpeciesController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/phylum', ['uses' => 'PhylumController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/phylum', ['uses' => 'PhylumController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/phylum', ['uses' => 'PhylumController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/class', ['uses' => 'ClassController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/class', ['uses' => 'ClassController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/class', ['uses' => 'ClassController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/genus', ['uses' => 'GenusController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/genus', ['uses' => 'GenusController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/genus', ['uses' => 'GenusController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/family', ['uses' => 'FamilyController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/family', ['uses' => 'FamilyController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/family', ['uses' => 'FamilyController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/order', ['uses' => 'OrderController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/order', ['uses' => 'OrderController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/order', ['uses' => 'OrderController@update', 'middleware' => ['auth', 'role:3']]);

/*Route::controller([
	'city'	=> 'System\CityController',
]);*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);