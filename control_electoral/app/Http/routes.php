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
use App\models\Alcaldes;

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

Route::get('persona/persona',function(){

	$lista=Alcaldes::all();

	return view('persona/persona',array('alcaldes'=>$lista));
});

Route::get('persona/consultar_persona',function(){
	return view('persona/consultar_persona');
});

Route::get('perfiles/perfiles',function(){
	return view('perfiles/perfiles');
});

Route::get('perfiles/perfil_modulos',function(){
	return view('perfiles/perfil_modulos');
});

Route::get('modulos/modulos',function(){
	return view('modulos/modulos');
});

Route::get('menus/menus',function(){
	return view('menus/menus');
});

//servicios
Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');

/*Login*/
Route::post('inicio/loguear','AtenticacionController@Loguear');
/*End login*/

/*Partido*/
Route::post('partido/guardar','PartidoController@Guardar');
Route::post('partido/consultar','PartidoController@Consultar');
Route::get('partido/consultarporcodigo/{id}','PartidoController@ConsultarPorCodigo');
Route::post('partido/eliminar','PartidoController@Eliminar');
/*Fin Partido*/

/*Alcalde*/
Route::post('alcalde/guardar','AlcaldeController@Guardar');
Route::post('alcalde/consultar','AlcaldeController@Consultar');
Route::get('alcalde/consultarporcodigo/{id}','AlcaldeController@ConsultarPorCodigo');
/*Fin Alcalde*/

/*Persona*/
Route::post('persona/crear','PersonaController@Crear');
Route::post('persona/actualizar','PersonaController@Actualizar');
Route::post('persona/consultar','PersonaController@Consultar');
Route::get('persona/consultarporcodigo/{id}','PersonaController@ConsultarPorCodigo');
/*Fin persona*/

/*Perfiles*/
Route::post('perfiles/guardar','PerfilesController@Guardar');
Route::post('perfiles/consultar','PerfilesController@Consultar');
Route::get('perfiles/consultarporcodigo/{id}','PerfilesController@ConsultarPorCodigo');
Route::get('perfiles/consultarmodulo/{id_perfil}','PerfilesController@ConsultarModulo');
Route::post('perfiles/agregarmodulos','PerfilesController@AgregarModulos');
Route::get('perfiles/consultarmodulosnoagregados/{id_perfil}','PerfilesController@ConsultarModulosNoAgregados');
Route::post('perfiles/eliminarperfilmodulo','PerfilesController@EliminarPerfilModulo');
/*Fin perfiles*/

/*Modulos*/
Route::post('modulos/guardar','ModulosController@Guardar');
Route::post('modulos/consultar','ModulosController@Consultar');
Route::get('modulos/consultarporcodigo/{id}','ModulosController@ConsultarPorCodigo');
Route::post('modulos/eliminarmodulo','ModulosController@EliminarModulo');
/*Fin modulos*/

/*Menu*/
Route::get('menu/consultarmenupormodulo/{id_modulo}','MenuController@ConsultarMenuPorModulo');
Route::post('menu/crear','MenuController@Crear');
/*Fin menu*/

use App\models\Menus;
Route::get('test',function(){
	return Menus::all();
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