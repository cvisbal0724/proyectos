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

use App\models\Partidos;

Route::get('/', function(){
	return view('inicio/index');
});

Route::get('inicio/login',function(){
	return view('inicio/login');
});

Route::get('inicio/home','HomeController@index');

Route::get('partido/partido',function(){
	return view('partido/partido');
});

Route::get('alcalde/alcalde',function(){

	$lista=Partidos::all();

	return view('alcalde/alcalde',array('partidos'=>$lista));
});

//servicios
Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');

/*Login*/
Route::post('inicio/loguear','AtenticacionController@Loguear');
/*End login*/

/*Partido*/
Route::post('partido/crear','PartidoController@Crear');
Route::post('partido/consultar','PartidoController@Consultar');
Route::get('partido/consultarporcodigo/{id}','PartidoController@ConsultarPorCodigo');
/*Fin Partido*/

use App\models\Menus;
Route::get('test',function(){
	
	/*$lista= Menus::all();
	$menu=array();

	foreach ($lista as $key => $row) {
		if ($row->id_padre==0) {
			$menu[]=array(
				'id'=>$row->id,
				'nombre'=>$row->nombre,
				'etiqueta'=>$row->etiqueta,
				'id_padre'=>$row->id_padre,
				'id_modulo'=>$row->id_modulo,
				'url'=>$row->url,
				'orden'=>$row->orden,
				'imagen'=>$row->imagen,
				'hijos'=>array());
		}
		
		foreach ($lista as $key2 => $row2) {
			if ($row->id==$row2->id_padre) {
				$menu[$key]['hijos'][]=$row2;
				
			}
		}
	}

	return $menu;*/

});