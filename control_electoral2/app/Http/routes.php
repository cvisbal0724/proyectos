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
use App\models\Perfiles;

Route::get('/', function(){
	return view('inicio/index');
});

Route::get('inicio/login',function(){
	return view('inicio/login');
});

Route::get('layouts/nombre_proyecto',function(){
	return view('layouts/nombre_proyecto');
});

Route::get('inicio/dashboard',function(){
	return view('inicio/dashboard');
});

Route::get('layouts/notificaciones',function(){
	return view('layouts/notificaciones');
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

Route::get('persona/nueva_persona',function(){

	return view('persona/nueva_persona');
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

Route::get('usuario/usuario',function(){
	$perfiles=Perfiles::all();
	return view('usuario/usuario',array('perfiles'=>$perfiles));
});

Route::get('usuario/consultar_usuario',function(){	
	return view('usuario/consultar_usuario');
});

Route::get('concejal/concejal',function(){	
	$partidos=Partidos::all();
	return view('concejal/concejal',array('partidos'=>$partidos));
});

Route::get('concejal/consultar_concejal',function(){
	return view('concejal/consultar_concejal');
});

Route::get('lideres/lider','LiderController@index');

Route::get('lideres/consultar_lider',function(){
	return view('lideres/consultar_lider');
});

Route::get('lideres/asociar_concejales',function(){
	return view('lideres/asociar_concejales');
});

Route::get('votantes/votante','VotanteController@index');

Route::get('votantes/consultar_votante',function(){
	return view('votantes/consultar_votante');
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
Route::post('persona/crearnuevapersona','PersonaController@CrearNuevaPersona');
Route::post('persona/actualizar','PersonaController@Actualizar');
Route::post('persona/actualizarnuevapersona','PersonaController@ActualizarNuevaPersona');
Route::post('persona/consultar','PersonaController@Consultar');
Route::get('persona/consultarporcodigo/{id}','PersonaController@ConsultarPorCodigo');
Route::post('persona/consultarporcriterios','PersonaController@ConsultarPorCriterios');
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
Route::get('menu/consultarmenupormodulo/{id_modulo?}','MenuController@ConsultarMenuPorModulo');
Route::post('menu/crear','MenuController@Crear');
Route::post('menu/actualizar','MenuController@Actualizar');
Route::get('menu/consultarporcodigo/{id}','MenuController@ConsultarPorCodigo');
Route::get('menu/eliminar/{id}','MenuController@Eliminar');
/*Fin menu*/

/*Usuario*/
Route::post('usuario/crear','UsuarioController@Crear');
Route::post('usuario/actualizar','UsuarioController@Actualizar');
Route::post('usuario/consultar','UsuarioController@Consultar');
Route::get('usuario/consultarporcodigo/{id}','UsuarioController@ConsultarPorCodigo');
/*Fin Usuario*/

/*Concejal*/
Route::post('concejal/crear','ConcejalController@Crear');
Route::post('concejal/actualizar','ConcejalController@Actualizar');
Route::post('concejal/consultar','ConcejalController@Consultar');
Route::get('concejal/consultarporcodigo/{id}','ConcejalController@ConsultarPorCodigo');
/*Fin concejal*/

/*Lider*/
Route::post('lider/crear','LiderController@Crear');
//Route::post('concejal/actualizar','ConcejalController@Actualizar');
Route::post('lider/consultar','LiderController@Consultar');
Route::post('lider/agregarliderconcejales','LiderController@AgregarLiderConcejales');
Route::post('lider/consultarliderconcejales','LiderController@ConsultarLiderConcejales');
//Route::get('concejal/consultarporcodigo/{id}','ConcejalController@ConsultarPorCodigo');
/*Fin Lider*/

/*Votante*/
Route::post('votante/crear','VotanteController@Crear');
Route::post('votante/consultar','VotanteController@Consultar');
/*Fin votante*/

use App\models\Menus;
use App\Enums\EnumPerfiles;
Route::get('test',function(){
	
echo EnumPerfiles::Alcalde;
});