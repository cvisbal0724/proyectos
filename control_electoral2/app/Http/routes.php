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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

Route::get('/', function(){
	return view('inicio/index');
});

Route::get('inicio/login','AutenticacionController@index');

Route::get('layouts/nombre_proyecto',function(){
	return view('layouts/nombre_proyecto');
});

Route::get('inicio/dashboard','DashBoardController@index');
	
Route::get('layouts/notificaciones','DashBoardController@Notificacion');

Route::get('inicio/home','HomeController@index');

Route::get('partido/partido',function(){
	if (Cookie::get('id_usuario')>0) {
		return view('partido/partido');
	}else{
		return view('inicio/acceso_denegado');
	}
	
});

Route::get('alcalde/alcalde',function(){

	if (Cookie::get('id_usuario')>0) {
		$lista=Partidos::all();
		return view('alcalde/alcalde',array('partidos'=>$lista));
	}else{
		return view('inicio/acceso_denegado');
	}
	
});

Route::get('persona/persona',function(){
	
	if (Cookie::get('id_usuario')>0) {
		$lista=Alcaldes::all();
	return view('persona/persona',array('alcaldes'=>$lista));
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('persona/nueva_persona',function(){
	if (Cookie::get('id_usuario')>0) {
		return view('persona/nueva_persona');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('persona/consultar_persona',function(){
	if (Cookie::get('id_usuario')>0) {
		return view('persona/consultar_persona');
	}else{
		return view('inicio/acceso_denegado');
	}
	
});

Route::get('perfiles/perfiles',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('perfiles/perfiles');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('perfiles/perfil_modulos',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('perfiles/perfil_modulos');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('modulos/modulos',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('modulos/modulos');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('menus/menus',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('menus/menus');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('usuario/usuario',function(){
	if (Cookie::get('id_usuario')>0) {
		$perfiles=Perfiles::all();
		return view('usuario/usuario',array('perfiles'=>$perfiles));
	}else{
		return view('inicio/acceso_denegado');
	}	
});

Route::get('usuario/consultar_usuario',function(){
	
	if (Cookie::get('id_usuario')>0) {
		return view('usuario/consultar_usuario');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('concejal/concejal',function(){		
	if (Cookie::get('id_usuario')>0) {
		$partidos=Partidos::all();
		return view('concejal/concejal',array('partidos'=>$partidos));
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('concejal/consultar_concejal',function(){
	if (Cookie::get('id_usuario')>0) {
		return view('concejal/consultar_concejal');
	}else{
		return view('inicio/acceso_denegado');
	}	
});

Route::get('lideres/lider','LiderController@index');

Route::get('lideres/consultar_lider',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('lideres/consultar_lider');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('lideres/asociar_concejales',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('lideres/asociar_concejales');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('votantes/votante','VotanteController@index');

Route::get('votantes/consultar_votante',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('votantes/consultar_votante');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('votantes/dar_de_baja',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('votantes/dar_de_baja');
	}else{
		return view('inicio/acceso_denegado');
	}

});

Route::get('votantes/registrar_voto',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('votantes/registrar_voto');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('votantes/reporte_votantes',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('votantes/reporte_votantes');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('concejal/concejal_entregado',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('concejal/concejal_entregado');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('lideres/lider_entregado',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('lideres/lider_entregado');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('usuario/cambiar_clave',function(){	
	if (Cookie::get('id_usuario')>0) {
		return view('usuario/cambiar_clave');
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('reportes/votos_por_partido',function(){	
	if (Cookie::get('id_usuario')>0) {
		$lista=Partidos::all();
		return view('reportes/votos_por_partido',array('partidos'=>$lista));
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('reportes/votos_por_responsables',function(){	
	if (Cookie::get('id_usuario')>0) {
		$lista=Partidos::all();
		return view('reportes/votos_por_responsables',array('partidos'=>$lista));
	}else{
		return view('inicio/acceso_denegado');
	}
});

Route::get('graficos/graficos','GraficosController@index');

Route::get('tt','GraficosController@test');
//servicios
Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');

/*Login*/
Route::post('inicio/loguear','AutenticacionController@Loguear');
Route::get('inicio/desloguear','AutenticacionController@Desloguear');
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
Route::post('usuario/cambiarclave','UsuarioController@CambiarClave');
Route::post('usuario/bloquearusuario','UsuarioController@BloquearUsuario');
Route::post('usuario/desbloquearusuario','UsuarioController@DesBloquearUsuario');
/*Fin Usuario*/

/*Concejal*/
Route::post('concejal/crear','ConcejalController@Crear');
Route::post('concejal/actualizar','ConcejalController@Actualizar');
Route::post('concejal/consultar','ConcejalController@Consultar');
Route::get('concejal/consultarporcodigo/{id}','ConcejalController@ConsultarPorCodigo');
Route::post('concejal/guardarentregas','ConcejalController@GuardarEntregas');
Route::post('concejal/obtenerentregas','ConcejalController@ObtenerEntregas');
Route::post('concejal/obtenerentregasporcodigo','ConcejalController@ObtenerEntregasPorCodigo');
Route::post('concejal/eliminarentregas','ConcejalController@EliminarEntregas');
/*Fin concejal*/

/*Lider*/
Route::post('lider/crear','LiderController@Crear');
//Route::post('concejal/actualizar','ConcejalController@Actualizar');
Route::post('lider/consultar','LiderController@Consultar');
Route::get('lider/consultarporcodigo/{id}','LiderController@ConsultarPorCodigo');
Route::post('lider/agregarliderconcejales','LiderController@AgregarLiderConcejales');
Route::post('lider/consultarliderconcejales','LiderController@ConsultarLiderConcejales');
Route::post('lider/eliminarliderconcejales','LiderController@EliminarLiderConcejales');
Route::post('lider/guardarentregas','LiderController@GuardarEntregas');
Route::post('lider/obtenerentregas','LiderController@ObtenerEntregas');
Route::post('lider/obtenerentregasporcodigo','LiderController@ObtenerEntregasPorCodigo');
Route::post('lider/eliminarentregas','LiderController@EliminarEntregas');
/*Fin Lider*/

/*Votante*/
Route::post('votante/crear','VotanteController@Crear');
Route::post('votante/consultar','VotanteController@Consultar');
Route::get('votante/consultarporcodigo/{id}','VotanteController@ConsultarPorCodigo');
Route::post('votante/actualizar','VotanteController@Actualizar');
Route::post('votante/dardebaja','VotanteController@DarDeBaja');
Route::post('votante/consultarconcejalylider','VotanteController@ConsultarConcejalYLider');
Route::get('votante/exportarpdf/{concejales}/{lideres}','VotanteController@ExportarPDF');
Route::post('votante/registrarvoto','VotanteController@RegistrarVoto');
Route::get('votante/obtenerlugaresdevotacion/{id_zona}','VotanteController@ObtenerLugaresDeVotacion');
Route::post('votante/obtenervotosporpartidos','VotanteController@ObtenerVotosPorPartidos');
/*Fin votante*/

/*graficos*/
Route::get('graficos/consultar','GraficosController@Consultar');
/*fin graficos*/

use App\models\Menus;
use App\Enums\EnumPerfiles;
Route::get('test2',function(){
	
echo Hash::make('12345');//EnumPerfiles::Alcalde;
});

Route::get('test','AutenticacionController@test');


Route::get('testpdf','HomeController@invoice');


Route::get('vista','HomeController@vista');