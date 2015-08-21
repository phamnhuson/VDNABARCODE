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

Route::post('/search', 'SearchController@search');

Route::get('/home', 'HomeController@index');

Route::resource('contact', 'ContactController');

Route::get('blast', 'BlastController@index');

Route::post('blast', 'BlastController@blast');

Route::get('/report', 'ReportController@index');

Route::get('/error', ['as' => 'error', 'uses' => 'ErrorController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/error', ['as' => 'error', 'uses' => 'ErrorController@clear', 'middleware' => ['auth', 'role:3']]);

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

Route::get('/ibarcode', ['uses' => 'IbarcodeController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/ibarcode', ['uses' => 'IbarcodeController@create', 'middleware' => ['auth', 'role:3']]);

Route::get('/delete_img', ['uses' => 'IbarcodeController@delete_img', 'middleware' => ['auth', 'role:3']]);

Route::get('/delete_file', ['uses' => 'IbarcodeController@delete_file', 'middleware' => ['auth', 'role:3']]);

Route::get('/delete_loca', ['uses' => 'IbarcodeController@delete_loca', 'middleware' => ['auth', 'role:3']]);

Route::put('/ibarcode', ['uses' => 'IbarcodeController@update', 'middleware' => ['auth', 'role:3']]);

Route::post('/ibarcode/import', ['uses' => 'IbarcodeController@importFromFile', 'middleware' => ['auth', 'role:3']]);

Route::get('/download_data', ['uses' => 'IbarcodeController@exportFile']);

Route::get('/barcode', ['uses' => 'BarcodeController@index', 'middleware' => ['auth', 'role:3']]);

Route::get('/viewbarcode', 'ViewbarcodeController@index');

Route::get('/phylogenetictree', 'PhylogeneticController@index');

Route::get('/phylogenetictree/update', 'PhylogeneticController@update');

Route::get('/message', ['uses' => 'MessageController@index', 'middleware' => ['auth', 'role:3']]);

Route::put('/message', ['uses' => 'MessageController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/inew', ['uses' => 'InewController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/inew', ['uses' => 'InewController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/inew', ['uses' => 'InewController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/news', ['uses' => 'NewsController@index']);

/*Route::controller([
	'city'	=> 'System\CityController',
]);*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);