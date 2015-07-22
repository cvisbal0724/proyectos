<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
PayU::$isTest =false;

Route::get('/', function()
{  
	return View::make('inicio/index');	
});

/*
Vistas
*/
Route::get('inicio/activar', function()
{  
	return View::make('inicio/activar');	
});
Route::get('inicio/login', function()
{  
	return View::make('inicio/login');	
});
Route::get('inicio/login_facebook', function()
{  
	return View::make('inicio/login_facebook');	
});
Route::get('inicio/productos', function()
{  
	return View::make('inicio/productos');	
});
Route::get('inicio/registrar', function()
{  
	return View::make('inicio/registrar');	
});
Route::get('historial/historial', function()
{  
	return View::make('historial/historial',array('rutaImagen'=>'administrador/source/imagen_productos/'));	
});
Route::get('mi_perfil/cuenta', function()
{  
	$tiposIdentificacion=TipoIdentificacion::all();
	return View::make('mi_perfil/cuenta',array('tiposIdentificacion'=>$tiposIdentificacion));	
});
Route::get('mi_perfil/mis_direcciones', function()
{  
	return View::make('mi_perfil/mis_direcciones');	
});
Route::get('pasos_para_pago/direcciones', function()
{  
	return View::make('pasos_para_pago/direcciones');	
});
/*Route::get('pasos_para_pago/tiempos', function()
{  
	return View::make('pasos_para_pago/tiempos');	
});*/
Route::get('pasos_para_pago/tiempos', 'TiemposController@GenerarTiempos');

Route::get('pasos_para_pago/credito', function()
{  
	return View::make('pasos_para_pago/credito');	
});
Route::get('pasos_para_pago/pse', function()
{  
	if (!Session::has('bancos')) {	
				
		$parameters = array(
		//Ingrese aquí el identificador de la cuenta.
		PayUParameters::PAYMENT_METHOD => PaymentMethods::PSE,
		//Ingrese aquí el nombre del pais.
		PayUParameters::COUNTRY => PayUCountries::CO,
		);
		$array=PayUPayments::getPSEBanks($parameters);
		$banks=$array->banks;
		Session::put('bancos',$banks);
	}
	return View::make('pasos_para_pago/pse',array('banks'=>Session::get('bancos')));	
});
Route::get('pasos_para_pago/contra_entrega', function()
{  
	return View::make('pasos_para_pago/contra_entrega');	
});
Route::get('pasos_para_pago/finalizar', function()
{  
	return View::make('pasos_para_pago/finalizar');	
});
Route::get('pasos_para_pago/metodos_de_pago', function()
{  
	return View::make('pasos_para_pago/metodos_de_pago');	
});
Route::get('pasos_para_pago/respuesta_banco', function()
{  
	return View::make('pasos_para_pago/respuesta_banco',array('respuestabanco'=>Session::get('respuestabanco')));	
});
Route::get('mas_informacion/nosotros', function()
{  
	return View::make('mas_informacion/nosotros');	
});
Route::get('mas_informacion/donde_llegamos', function()
{  
	return View::make('mas_informacion/donde_llegamos');	
});
Route::get('mas_informacion/mapa', function()
{  
	return View::make('mas_informacion/mapa');	
});
Route::get('mas_informacion/preguntas_frecuentes', function()
{  
	return View::make('mas_informacion/preguntas_frecuentes');	
});
Route::get('mas_informacion/aliados_estrategicos', function()
{  
	return View::make('mas_informacion/aliados_estrategicos');	
});
Route::get('mas_informacion/politicas_de_privacidad', function()
{  
	return View::make('mas_informacion/politicas_de_privacidad');	
});
Route::get('mas_informacion/terminos_y_condiciones', function()
{  
	return View::make('mas_informacion/terminos_y_condiciones');	
});
Route::get('mas_informacion/pqr', function()
{  
	return View::make('mas_informacion/pqr');	
});
Route::get('inicio/cambiar_clave', function()
{  
	return View::make('inicio/cambiar_clave');	
});

Route::get('calificanos/calificanos',function(){
	return View::make('calificanos/calificanos');
});

/*
Fin vistas
*/

/*Vistas parciales*/
Route::get('layouts/buscador', function()
{  
	return View::make('layouts/buscador');	
});
Route::get('layouts/canasta', function()
{  
	return View::make('layouts/canasta');	
});
Route::get('layouts/categorias', function()
{  
	return View::make('layouts/categorias');	
});
Route::get('layouts/encabezadoinicio', function()
{  
	return View::make('layouts/encabezadoInicio');	
});
Route::get('layouts/encabezadovistas', function()
{  
	return View::make('layouts/encabezadoVistas');	
});
Route::get('layouts/footer', function()
{  
	return View::make('layouts/footer');	
});
Route::get('layouts/header', function()
{  
	return View::make('layouts/header');	
});
Route::get('layouts/headervistas', function()
{  
	return View::make('layouts/headerVistas');	
});
Route::get('layouts/masinformacion', function()
{  
	return View::make('layouts/masInformacion');	
});
/*Fin vistas`parciales*/



Route::post('categoria/obtenertodos', 'CategoriaController@ObtenerTodos');

Route::get('/login/',function(){

	if (Session::has('usuario')) {
		return View::make('inicio/index');
	}

});

Route::get('/registrar/',function(){
	
	return View::make('inicio/registrar');
	
});

Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');


/*Usuario*/
Route::get('/login/', 'AutenticacionController@login');
Route::post('login/auth','AutenticacionController@Loguear');
Route::post('login/authporcookie','AutenticacionController@LoguearPorCookie');
Route::post('login/logout','AutenticacionController@Logout');
Route::post('login/logoutporcookie','AutenticacionController@LogoutPorCookie');
Route::get('login/loguearporfacebook/{auth?}','AutenticacionController@LoguearPorFacebook');
Route::get('login/desloguearporfacebook','AutenticacionController@DesloguearPorFacebook');
Route::post('login/obtenerdatosfacebook','AutenticacionController@ObtenerDatosFacebook');
Route::get('login/loguearporgoogle/{auth?}','AutenticacionController@LoguearPorGoogle');

Route::post('usuario/obtenertodos','UsuarioController@ObtenerTodos');
Route::post('usuario/obtenercuenta','UsuarioController@ObtenerCuenta');
Route::post('usuario/obtenertipoidentificacion','UsuarioController@ObtenerTipoIdentificacion');
Route::post('usuario/modificar','UsuarioController@Modificar');
Route::post('usuario/crear','UsuarioController@Crear');
Route::post('usuario/crearconfacebook','UsuarioController@CrearConFaceBook');
Route::post('usuario/activar','UsuarioController@ActivarCuenta');//->where('slashData', '(.*)');
Route::get('usuario/recuperarclave/{correo}','UsuarioController@RecuperarClave');
Route::post('usuario/cambiarclave','UsuarioController@CambiarClave');
/*fin Usuario*/

/*PRODUCTO*/
Route::post('producto/obtenertodos','ProductoController@ObtenerTodos');
/*FIN PRODUCTO*/


/*PRODUCTO PROVEEDOR*/
Route::post('productoproveedor/obtenerinicio','ProductoProveedorController@ObtenerInicio');
Route::post('productoproveedor/obtenerporcategoria','ProductoProveedorController@ObtenerPorCategorias');
Route::post('productoproveedor/agregarcanasta','ProductoProveedorController@AgregarCanasta');
Route::post('productoproveedor/cargarproductosagregados','ProductoProveedorController@CargarProductosAgregados');
Route::get('productoproveedor/removeproductoagregado/{id?}','ProductoProveedorController@RemoveProductoAgregado');
Route::post('productoproveedor/agregarcantidadesdesdecanasta','ProductoProveedorController@AgregarCantidadesDesdeCanasta');
Route::post('productoproveedor/agregarlistacompra','ProductoProveedorController@AgregarListaCompra');
Route::post('productoproveedor/obtenerporparecidos','ProductoProveedorController@ObtenerPorParecidos');
Route::post('productoproveedor/obtenerporidprovedorproducto','ProductoProveedorController@ObtenerPorIDProvedorProducto');
/*FIN PRODUCTO*/


/*Direcciones Persona*/
Route::post('direccionespersona/obtenerdirecciones','BarrioPersonaController@ObtenerPorPersona');
Route::post('direccionespersona/crear','BarrioPersonaController@Crear');
Route::post('direccionespersona/seleccionar','BarrioPersonaController@SeleccionarDireccion');
Route::post('direccionespersona/obtenerporid','BarrioPersonaController@ObtenerPorID');
Route::post('direccionespersona/modificar','BarrioPersonaController@Modificar');
Route::post('direccionespersona/quitardireccion','BarrioPersonaController@QuitarDireccion');
/*Fin direcciones persona*/


/*Barrio*/
Route::post('barrio/obtenertodos','BarrioController@ObtenerTodos');
Route::post('barrioproveedor/obtenertodos','BarrioProveedorController@ObtenerTodos');	
/*Fin Barrio*/

/*Tiempos*/
Route::post('tiempos/obtenertodos','TiemposController@GenerarTiempos');
Route::post('tiempos/seleccionartiempo','TiemposController@SeleccionarTiempo');
/*Fin Tiempos*/

/*Orden de servicio*/
Route::post('ordenservicio/crear','OrdenServicioController@Crear');
Route::post('ordenservicio/obtenerporcriterios','OrdenServicioController@ObtenerPorCriterios');
Route::post('ordenservicio/obtenerlosultimostres','OrdenServicioController@ObtenerLosUltimosTres');
Route::post('ordenservicio/pagotarjetacredito','OrdenServicioController@PagoTarjetaCredito');
Route::post('ordenservicio/terminarprocesodepagobancario','OrdenServicioController@TerminarProcesoDePagoBancario');
Route::post('ordenservicio/obtenerporcodigo','OrdenServicioController@ObtenerPorCodigo');
/*Fin Orden de servicio*/


/*Finalizar*/
Route::post('ordenservicio/finalizar','OrdenServicioController@Finalizar');
/*Fin Finalizar*/

/*Calificanos*/
Route::post('calificanos/crear','CalificanosController@Crear');
Route::post('calificanos/obtenercompraporcodigo','CalificanosController@ObtenerCompraPorCodigo');
/*fin Calificanos*/


/*Pasos Para Pago*/
Route::get('/checkout/','PasosPagoController@Checkout');
/*Fin pasos para pagos*/

/*Mas Informacion*/
Route::post('pqr/crear','PQRController@Crear');
/*Fin mas informacion*/

/*Validar Si hay productos*/
Route::get('validarexistenproductos',function(){

	$id=Cookie::get('id_user');
	if ($id>0) {
		$id_user=Cookie::get('id_user');

		$listaTempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)->get();

		return count($listaTempComp);	
	}

});

Route::get('tieneDireccion', function(){
	if (Session::has('id_direccion')) {
		return Session::get('id_direccion');
	}else{
		return 0;
	}
});

Route::get('tieneTiempo', function(){
	if (Session::has('hora') && Session::has('fecha')) {
		return 'true';
	}else{
		return 'false';
	}
});

Route::get('validarValorMinimo', function(){
	$proveedor=Proveedor::find(1);
	return $proveedor->VALOR_MINIMO;
});

/*Validar*/

/*Cupon*/

Route::get('bono/guardar/{codigo}','OrdenServicioController@GuardarUsuarioCupon');

/*Fin cupon*/



//https://github.com/noiselabs/NoiselabsNuSOAPBundle //web service

//Route::get('pagobancario','OrdenServicioController@PagoTransferenciasBancarias');

Route::get('ordenservicio/respuestadelbanco','OrdenServicioController@RespuestaDelBanco');
Route::get('ordenservicio/reintertarpagobancario','OrdenServicioController@ReintertarPagoBancario');


Route::get('admin',function(){

	return Redirect::to(Request::root().'/administrador/login.php');

});

///////////////Pruebas


Route::get('test2', function(){

$date = '2007/10/31';
 
$weekday = date('l', strtotime($date)); // note: first arg to date() is lower-case L
 
return $weekday; // SHOULD display Wednesday

});


Route::get('correo', function()
{
	return View::make('plantilla_correo/crear_cuenta');	
	
});


Route::get('recordar',function(){
	$data=array(
					'nombres'=>'Carlos',
					'key'=>Request::root().'/#/cambiar-contrasena/12365'
				);
	return View::make('plantilla_correo/recordar_clave',$data);	
});

Route::get('datediff',function(){

/*$date1 = '2015-06-15';
$date2 = '2015-06-14';
$ts1 = strtotime($date1);
$ts2 = strtotime($date2);
$seconds_diff = $ts2 - $ts1;//getdate();//date_diff('5/10/2015', '5/11/2015');
return $seconds_diff / ( 60 * 60);*/

return date('Y/m/d',strtotime('2015-01-26 00:00:00'));//date('Y/m/d');	

});


Route::get('path',function(){
//return $_SERVER["DOCUMENT_ROOT"];
	//return View::make('calificanos/calificanos');



$key=array('id_orden'=>349);
		return		$arrayString=Encriptacion::encrypt($key, Encriptacion::ENCRYPTION_KEY);

});

Route::get('getdate',function(){
	$date=date('Y/m/d');
	return date('Y/m/d', strtotime($date. ' + 15 day'));
});

Route::get('formatonumero',function(){

	return getCreditCardType('4111111111111111');

});


function getCreditCardType($str, $format = 'string')
    {
        if (empty($str)) {
            return false;
        }

        $matchingPatterns = [
            'VISA' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
            'MASTERCARD' => '/^5[1-5][0-9]{14}$/',
            'AMEX' => '/^3[47][0-9]{13}$/',
            'DINERS' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
            'discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
            'jcb' => '/^(?:2131|1800|35\d{3})\d{11}$/',
            'any' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
        ];

        $ctr = 1;
        foreach ($matchingPatterns as $key=>$pattern) {
            if (preg_match($pattern, $str)) {
                return $format == 'string' ? $key : $ctr;
            }
            $ctr++;
        }
    }

/*merchantId=530880
merchant_name=Inversiones+y+Obras+S.A.S
merchant_address=Cra+76+no+81a-15
telephone=3014422246
merchant_url=http%3A%2F%2Fwww.mercafresco.co%2F
transactionState=6
lapTransactionState=DECLINED
message=Declinada
referenceCode=mercafresco_pago_00000001
reference_pol=92192550
transactionId=34776422-8bd2-402c-adec-b924f231fff5
description=Pago+en+mercafresco
trazabilityCode=152919330
cus=152919330
orderLanguage=es
extra1=
extra2=
extra3=
polTransactionState=6
signature=bbdf55344edde6756685380e0f2d5cae
polResponseCode=4
lapResponseCode=PAYMENT_NETWORK_REJECTED
risk=.00
polPaymentMethod=25
lapPaymentMethod=PSE
polPaymentMethodType=4
lapPaymentMethodType=PSE
installmentsNumber=1
TX_VALUE=10000.00
TX_TAX=1379.00
currency=COP
lng=es
pseCycle=-1
buyerEmail=cvisbal0724%40gmail.com
pseBank=
pseReference1=127.0.0.1
pseReference2=CC
pseReference3=1044422259
authorizationCode=
TX_ADMINISTRATIVE_FEE=.00
TX_TAX_ADMINISTRATIVE_FEE=.00
TX_TAX_ADMINISTRATIVE_FEE_RETURN_BASE=.00*/

//?merchantId=530880&merchant_name=Inversiones+y+Obras+S.A.S&merchant_address=Cra+76+no+81a-15&telephone=3014422246&merchant_url=http%3A%2F%2Fwww.mercafresco.co%2F&transactionState=6&lapTransactionState=DECLINED&message=Declinada&referenceCode=mercafresco_pago_00000001&reference_pol=92192550&transactionId=34776422-8bd2-402c-adec-b924f231fff5&description=Pago+en+mercafresco&trazabilityCode=152919330&cus=152919330&orderLanguage=es&extra1=&extra2=&extra3=&polTransactionState=6&signature=bbdf55344edde6756685380e0f2d5cae&polResponseCode=4&lapResponseCode=PAYMENT_NETWORK_REJECTED&risk=.00&polPaymentMethod=25&lapPaymentMethod=PSE&polPaymentMethodType=4&lapPaymentMethodType=PSE&installmentsNumber=1&TX_VALUE=10000.00&TX_TAX=1379.00&currency=COP&lng=es&pseCycle=-1&buyerEmail=cvisbal0724%40gmail.com&pseBank=&pseReference1=127.0.0.1&pseReference2=CC&pseReference3=1044422259&authorizationCode=&TX_ADMINISTRATIVE_FEE=.00&TX_TAX_ADMINISTRATIVE_FEE=.00&TX_TAX_ADMINISTRATIVE_FEE_RETURN_BASE=.00