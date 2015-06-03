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

use App\models\Alcaldes;
use App\models\Partidos;
use App\models\Perfiles;
use App\models\Usuarios;
use App\models\Personas;
use \Illuminate\Support\Facades\DB;

Route::get('test',function(){
	

			 DB::table('partidos')->delete();
       
       $par=Partidos::create(array(       		
        	'nombre'=>'U'
        ));

       $alc=Alcaldes::create(array(
        	'nombre'=>'Geovany Vergara',
        	'id_partido'=>$par['id'],
        	'numero'=>1        	
        ));

        /*$perfiles=['Administrador','Alcalde','Concejales','Lider'];

		foreach ($perfiles as $key => $value) {
			 Perfiles::create(array(
		        	'nombre'=>$value
		      ));
		}
		
		$per=Personas::create(array(
			'cedula'=>'1044422259',
			'nombre'=>'Carlos',
			'apellido'=>'Visbal',
			'telefono'=>'3014647797',
			'direccion'=>'Calle 10'
			'id_alcalde'=>$alc['id'],
		));

		Usuarios::create(array(

			'usuario'=>'cvisbal',
			'password'=>Hash::make('12345'),
			'id_persona'=>$per['id'],
			'id_perfil'=>1

		));*/
});