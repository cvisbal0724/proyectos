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

/*Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::get('/', function(){
	return view('inicio/index');
});

Route::get('inicio/login',function(){
	return view('inicio/login');
});

//servicios
Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');

/*Login*/
Route::post('inicio/loguear','AtenticacionController@Loguear');
/*End login*/

use App\models\Usuarios;

Route::get('test',function(){
	//return Usuarios::all();

	/*Usuarios::create(
	       	array(
		       	'id_perfil'=>1,
		       	'id_persona'=>1,
		       	'password'=>Hash::make('12345'),
		       	'usuario'=>'cvisbal',
	       )
       );*/
});