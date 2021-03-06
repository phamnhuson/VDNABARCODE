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

Route::get('/introduction', array('as' => 'introduction', function(){
	return App::make('App\Http\Controllers\PageController')->index(22);
}));

Route::get('/service', array('as' => 'introduction', function(){
	return App::make('App\Http\Controllers\PageController')->index(24);
}));

Route::get('/help', array('as' => 'introduction', function(){
	return App::make('App\Http\Controllers\PageController')->index(23);
}));


Route::get('/illustrativebarcode', function(){
	return view('generatebarcode');
});

Route::get('login', ['uses' => 'Auth\AuthController@login', 'middleware' => ['guest']]);

Route::post('login', ['uses' => 'Auth\AuthController@authenticate', 'middleware' => ['guest']]);

Route::get('logout', ['uses' => 'Auth\AuthController@logout', 'middleware' => ['auth']]);

Route::get('/search/{searchType}', 'SearchController@index');

Route::get('/search', 'SearchController@search');

Route::post('/search', 'SearchController@search');

Route::get('/home', 'HomeController@index');

Route::resource('contact', 'ContactController');


Route::get('blast', 'BlastController@index');

Route::post('blast', 'BlastController@blast');

Route::get('treeview', 'TreeviewController@index');

Route::get('treeview/job/{jobId}', 'TreeviewController@index');

Route::post('treeview', 'TreeviewController@create');

Route::get('/report', 'ReportController@index');

Route::get('/error', ['as' => 'error', 'uses' => 'ErrorController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/error', ['as' => 'error', 'uses' => 'ErrorController@clear', 'middleware' => ['auth', 'role:3']]);

Route::get('/user', ['as' => 'user', 'uses' => 'UserController@index', 'middleware' => ['auth', 'role:3']]);

Route::get('/backup', ['as' => 'backup', 'uses' => 'BackupController@index', 'middleware' => ['auth', 'role:3']]);

Route::get('/backup/download/{file}', ['as' => 'backup_download', 'uses' => 'BackupController@getDownload', 'middleware' => ['auth', 'role:3']]);

Route::post('/user', ['uses' => 'UserController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/user', ['uses' => 'UserController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/city', ['uses' => 'CityController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/city', ['uses' => 'CityController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/city', ['uses' => 'CityController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/species', ['uses' => 'SpeciesController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/species', ['uses' => 'SpeciesController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/species', ['uses' => 'SpeciesController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/kingdom', ['uses' => 'KingdomController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/kingdom', ['uses' => 'KingdomController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/kingdom', ['uses' => 'KingdomController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/phylum', ['uses' => 'PhylumController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/phylum', ['uses' => 'PhylumController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/phylum', ['uses' => 'PhylumController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/class', ['uses' => 'ClassController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/class', ['uses' => 'ClassController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/class', ['uses' => 'ClassController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/genus', ['uses' => 'GenusController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/genus', ['uses' => 'GenusController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/genus', ['uses' => 'GenusController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/family', ['uses' => 'FamilyController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/family', ['uses' => 'FamilyController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/family', ['uses' => 'FamilyController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/order', ['uses' => 'OrderController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/order', ['uses' => 'OrderController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/order', ['uses' => 'OrderController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/ibarcode', ['uses' => 'IbarcodeController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/delete_img', ['uses' => 'IbarcodeController@delete_img', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/delete_file', ['uses' => 'IbarcodeController@delete_file', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/delete_loca', ['uses' => 'IbarcodeController@delete_loca', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/delete_city', ['uses' => 'IbarcodeController@delete_city', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/ibarcode', ['uses' => 'IbarcodeController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/ibarcode', ['uses' => 'IbarcodeController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/ibarcode/import', ['uses' => 'IbarcodeController@importFromFile', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/download_data', ['uses' => 'IbarcodeController@exportFile']);

Route::get('/barcode', ['uses' => 'BarcodeController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/accept', ['uses' => 'BarcodeController@accept', 'middleware' => ['auth', 'role:3']]);

Route::get('/viewbarcode', 'ViewbarcodeController@index');

Route::get('/viewgene', 'ViewgeneController@index');

Route::get('/phylogenetictree', 'PhylogeneticController@index');

Route::get('/phylogenetictree/update', 'PhylogeneticController@update');

Route::get('/message', ['uses' => 'MessageController@index', 'middleware' => ['auth', 'role:3']]);

Route::put('/message', ['uses' => 'MessageController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/inew', ['uses' => 'InewController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/inew', ['uses' => 'InewController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/inew', ['uses' => 'InewController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/publication', ['uses' => 'NewsController@index']);

Route::post('/news', ['uses' => 'NewsController@comment']);

Route::get('/dnabarcode/{cat?}/{id?}', ['uses' => 'ListController@index']);

Route::get('/listgene', ['uses' => 'ListgeneController@index']);

Route::get('/register', ['uses' => 'RegisterController@index',]);

Route::post('/register', ['uses' => 'RegisterController@create',]);

Route::put('/register', ['uses' => 'RegisterController@update',]);

Route::get('/member', ['uses' => 'MemberController@index']);

Route::get('/get_phylum', ['uses' => 'ClassController@get_phylum', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/get_class', ['uses' => 'ClassController@get_class', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/get_order', ['uses' => 'OrderController@get_order', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/get_family', ['uses' => 'FamilyController@get_family', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/get_genus', ['uses' => 'GenusController@get_genus', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/get_species', ['uses' => 'SpeciesController@get_species', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/viewspecies', ['uses' => 'SpeciesController@viewspecies']);

Route::get('/ipublication', ['uses' => 'PublicController@index', 'middleware' => ['auth']]);

Route::post('/ipublication', ['uses' => 'PublicController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/ipublication', ['uses' => 'PublicController@update', 'middleware' => ['auth', 'role:3']]);

Route::get('/igene', ['uses' => 'IgeneController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/igene', ['uses' => 'IgeneController@create', 'middleware' => ['auth', 'role:1,3']]);

Route::put('/igene', ['uses' => 'IgeneController@update', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/gene', ['uses' => 'GeneController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/igenome', ['uses' => 'GenomeController@index', 'middleware' => ['auth', 'role:3']]);

Route::get('/genome/{id?}', ['uses' => 'GenomeController@showList']);

Route::put('/igenome', ['uses' => 'GenomeController@update', 'middleware' => ['auth', 'role:3']]);

Route::post('/igenome', ['uses' => 'GenomeController@create', 'middleware' => ['auth', 'role:3']]);

Route::get('/link', ['uses' => 'LinkController@index', 'middleware' => ['auth', 'role:3']]);

Route::post('/link', ['uses' => 'LinkController@create', 'middleware' => ['auth', 'role:3']]);

Route::put('/link', ['uses' => 'LinkController@update', 'middleware' => ['auth', 'role:3']]);

/*Route::controller([
	'city'	=> 'System\CityController',
]);*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);