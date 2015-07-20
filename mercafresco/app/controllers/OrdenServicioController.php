<?php


class OrdenServicioController extends BaseController {

protected $rutaImagen ='administrador/source/imagen_productos/';

public function Crear(){

	if (!Session::has('id_direccion') || !Session::has('hora') || !Session::has('fecha')) {
		return array('ID'=>0,'msg'=>'Por favor selecciones la hora en la que desea la entrega de su pedido.');	
	}	
	else{

	/*$consecutivo=Consecutivo::find(1);
	$consecutivo->CONSECUTIVO+=1;
	$consecutivo->save();
	$numeroConsecutivo=	$consecutivo->CONSECUTIVO;*/
	
	DB::beginTransaction();
	
	try {
	

	$id_user=Cookie::get('id_user');
	$usuario=Usuario::find($id_user);
	Session::put('usuario',$usuario);
	$empresaconvenio=null;
    $cedula=$usuario->persona->NO_IDENTIFICACION;
   
	$funcionario=Funcionario::where('CEDULA','=',$cedula)->first();
	$bonoUsuario=UsuarioBono::where('ID_USUARIO','=',$usuario->ID)->where('USADO','=',0)->first();


	
	$rs=OrdenServicio::create(array(
	  
		"ID_TIPO_METODO_PAGO"=>Input::get('id_metodo_pago'),	
		"ID_BARRIO_PERSONA"=>Session::get('id_direccion'),
		"ID_BONO"=>$bonoUsuario!=null ? $bonoUsuario->ID_BONO : DB::raw('NULL'),
		"PROG_FECHA"=>Session::get('fecha'),
		"PROG_HORA"=>Session::get('hora'),
		//"FECHA_ENTREGA"=>Input::get("fecha_entrega"),
		"VALOR_DOMICILIO"=>0,
		"ID_PROVEEDOR"=>1,
		"FECHA_CREACION"=>DB::raw('NOW()'),
		"ID_USUARIO"=>$id_user,
		"ID_ESTADO_ENTREGA"=>1,
		"ESTADO"=>1,
		"ID_ESTADO_PAGO"=>1,
		"MENSAJE_ENVIADO"=>0
		//"CONSECUTIVO"=>$numeroConsecutivo	

	)); 

 	if ($bonoUsuario) {
		$bonoUsuario->USADO=1;
		$bonoUsuario->save();
	}

 	$listaTempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)->get();

 	if ($rs["ID"]>0 && count($listaTempComp)>0) {

 		Session::put('id_orden',$rs["ID"]);

 		foreach ($listaTempComp as $key => $item) {

 			$prodProv=ProductosProveedor::find($item->ID_PRODUCTO_PROVEEDOR);

 			if ($bonoUsuario==null && $funcionario) {

				$empresaconvenio=EmpresaConvenio::where('ID_EMPRESA','=',$funcionario->ID_EMPRESA)
				->where('ID_PROVEEDOR','=',$prodProv->ID_PROVEEDOR)
				->where('ID_CATEGORIA','=',$prodProv->Producto->ID_CATEGORIA)
				->where('ACTIVO','=',1)->first();
				
			}

 			HistorialCompra::create(array(
 				'ID_ORDEN_SERVICIO' =>$rs['ID'],
 				'ID_IVA' =>$prodProv->Iva->ID,
 				'CATEGORIA' =>$prodProv->Producto->Categoria->NOMBRE,
 				'PRODUCTO' =>$prodProv->Producto->NOMBRE,
 				'DESCRIPCION' =>$prodProv->DESCRIPCION,	
 				'FABRICANTE' =>$prodProv->Fabricante->ID,
 				'PRODUCTOS_OFRECIDOS' =>$prodProv->PRODUCTOS_OFRECIDOS,
 				'UNIDAD' =>$prodProv->Unidad->NOMBRE,
 				'CANTIDAD_COMPRADOS' =>$item->CANTIDAD,
 				'PRECIO' =>$prodProv->PRECIO,
 				'IVA_TASA' =>$prodProv->IVA_TASA,
 				'FECHA_CREACION'=> DB::raw('NOW()'),
 				'ESTADO'=>1,
 				'ID_PRODUCTO_PROVEEDOR'=>$item->ID_PRODUCTO_PROVEEDOR,
 				'ID_EMPRESA_CONVENIO'=>$empresaconvenio!=NULL ? $empresaconvenio->ID : DB::raw('NULL'),
 				'PORCENTAJE_CONVENIO'=>$empresaconvenio!=NULL ? $empresaconvenio->PORCENTAJE : 0
 			));

 			$prodProv->INVENTARIO = $prodProv->INVENTARIO - $item->CANTIDAD;
 			$prodProv->save();

 		}

 	}
 	
 	TemporalCompra::where('ID_USUARIO','=', $id_user)->delete();
 	
 	$item=OrdenServicio::find($rs["ID"]);
	
 	$data=array(
 		'id'=>$rs["ID"],
		'cliente'=>$usuario->persona->NOMBRES . ' ' . $usuario->persona->APELLIDOS,
		'celular'=>$usuario->persona->CELULAR,
		'telefono'=>$usuario->persona->TELEFONO,
		'formapago'=>$item->tipometodopago->NOMBRE,
		'fecha_envio'=>$item->PROG_FECHA,
		'barrio'=>$item->barriopersona->barrio->NOMBRE,
		'direccion'=>$item->barriopersona->DIRECCION,
		'recibe'=>$item->barriopersona->QUIEN_RECIBE,
		'productos'=>$item->CantidadProductos(),
		'domicilio'=>$item->VALOR_DOMICILIO,
		'total'=>$item->Total(),
		'convenio'=>(double)$item->Convenio(),
		'descuentobono'=>(double)$item->DescuentoBono()
 	);

    $respuesta=null;
	
	//PAGAR CON TARJETA DE CREDITO	
	if (Input::get('id_metodo_pago')=='3') {
	   $respuesta=$this->PagoTarjetaCredito($item);
	   if ($respuesta->transactionResponse->state=='DECLINED' || $respuesta->transactionResponse->state=='ERROR') {
	   		DB::rollback();
	   		return array('ID'=>0,'msg'=>'Lo sentimos su tarjeta fue rechazada por su entidad.');	
	   }elseif ($respuesta->transactionResponse->state=='APPROVED' || $respuesta->transactionResponse->state=='PENDING') {
	   		$item->ID_TRANSACCION= $respuesta!=null ? $respuesta->transactionResponse->transactionId : DB::raw('NULL');
			$item->ID_ORDEN_TRANSACCION= $respuesta!=null ? $respuesta->transactionResponse->orderId : DB::raw('NULL');
			$item->ESTADO_TRANSACCION= $respuesta!=null ? $respuesta->transactionResponse->state : DB::raw('NULL');
			$item->CODIGO_RESPUESTA= $respuesta!=null ? $respuesta->transactionResponse->responseCode : DB::raw('NULL');
			$item->RAZON_PENDIENTE=  $respuesta!=null && $respuesta->transactionResponse->state=='PENDING' ? $respuesta->transactionResponse->pendingReason : DB::raw('NULL');
	   		$item->ID_ESTADO_PAGO=2;
	   		$item->save();	   		
	   }
	}
	else if (Input::get('id_metodo_pago')=='4') {//PAGAR CON PSE

		$respuesta=$this->PagoTransferenciasBancarias($item);
		
		$item->ID_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->transactionId : DB::raw('NULL');
		$item->ID_ORDEN_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->orderId : DB::raw('NULL');
		$item->ESTADO_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->state : DB::raw('NULL');
		$item->CODIGO_RESPUESTA= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->responseCode : DB::raw('NULL');
		$item->RAZON_PENDIENTE=  $respuesta->transactionResponse!=null && $respuesta->transactionResponse->state=='PENDING' ? $respuesta->transactionResponse->pendingReason : DB::raw('NULL');
	   	$item->ID_ESTADO_PAGO=5;
	   	$item->save();	 
	   	
	   	DB::commit();	   	
	   	Session::put('OrderServicio',$item);
	   	Session::put('id_orden',$rs["ID"]);
	 	Session::forget('id_direccion');
	 	Session::forget('fecha');
		Session::forget('hora');
		
		return array('ID'=>'url','msg'=>'','url'=>$respuesta->transactionResponse->extraParameters->BANK_URL);	
			
	}

 	Mail::send('plantilla_correo/crear_pedido', $data, function($message){
 		$usuario=Session::get('usuario');
 		$id_orden=Session::get('id_orden');
 		$email=$usuario->persona->EMAIL;
 		$cliente=$usuario->persona->NOMBRES.' '.$usuario->persona->APELLIDOS;
 		$message->bcc('contacto@mercafresco.co', $name = null);
		$message->to($email, $cliente)->subject('Pedido No. '.$id_orden.' realizado correctamente');
	});

	DB::commit();

 	Session::put('id_orden',$rs["ID"]);
 	Session::forget('id_direccion');
 	Session::forget('fecha');
	Session::forget('hora');
 	return array('ID'=>$rs["ID"],'msg'=>'success');

	} catch (Exception $e) {
		
		DB::rollback();
		Excepciones::Crear($e,'OrdenServicio','Crear');
		return array('ID'=>0,'msg'=>$e->getMessage());	
	}
 	
 }
}

public function Finalizar(){
	try {

		if (Session::has('id_orden')) {
		$usuario=Session::get('usuario');
		$Horas = array(8  => '08 am - 10 am',
		 10 => '10 am - 12 m',
		 12 => '12 m - 02 pm',
		 14 => '02 pm - 04 pm',
		 16 => '04 pm - 06 pm');

		$id=Session::get('id_orden');

		$item=OrdenServicio::find($id);

		$lista=array(
			'cliente'=>ucfirst(strtolower($usuario->persona->NOMBRES)) . ' ' . ucfirst(strtolower($usuario->persona->APELLIDOS)),
			'celular'=>$usuario->persona->CELULAR,
			'barrio'=>strtolower($item->barriopersona->barrio->NOMBRE),
			'direccion'=>$item->barriopersona->DIRECCION,
			'id'=>$item->ID,
			'total'=>$item->Total(),
			'formapago'=>ucfirst(strtolower($item->tipometodopago->NOMBRE)),			
			'dia'=>$item->PROG_FECHA,
			'hora'=>$Horas[$item->PROG_HORA],			
			'recibe'=>strtolower($item->barriopersona->QUIEN_RECIBE),
			'productos'=>$item->CantidadProductos(),
			'domicilio'=>$item->VALOR_DOMICILIO,
			'email'=>strtolower($usuario->persona->EMAIL),
			'convenio'=>$item->Convenio(),
			'descuentobono'=>(double)$item->DescuentoBono()
			
		);

		//Session::forget('id_orden');
		Session::forget('id_direccion');
		Session::forget('hora');
		Session::forget('fecha');
		//print_r($lista);
		return $lista;

	}

	}		
	 catch (Exception $e) {
		Excepciones::Crear($e,'OrdenServicio','Finalizar');
	}	

}

public function Modificar(){
 try {
 	 $id=Input::get("id");
 
	  $orden_servicio=OrdenServicio::find($id);
	  $orden_servicio->ID_ESTADO_PAGO=Input::get("id_estado_pago");
	  $orden_servicio->ID_METODO_PAGO_PERSONA=Input::get("id_metodo_pago_persona");
	  $orden_servicio->ID_BARRIO_PERSONA=Input::get("id_barrio_persona");
	  $orden_servicio->ID_BONO=Input::get("id_bono");
	  $orden_servicio->PROG_FECHA=Input::get("prog_fecha");
	  $orden_servicio->PROG_HORA=Input::get("prog_hora");
	  $orden_servicio->FECHA_ENTREGA=Input::get("fecha_entrega");
	  $orden_servicio->ID=Input::get("id");
	  $orden_servicio->VALOR_DOMICILIO=Input::get("valor_domicilio");
	  $orden_servicio->ID_PROVEEDOR=Input::get("id_proveedor");
	  $orden_servicio->FECHA_CREACION=Input::get("fecha_creacion");
	  $orden_servicio->ID_USUARIO=Input::get("id_usuario");
	  $orden_servicio->FECHA_MODIFICACION=Input::get("fecha_modificacion");
	  $orden_servicio->ID_ESTADO_ENTREGA=Input::get("id_estado_entrega");
	  $orden_servicio->ESTADO=Input::get("estado");
	  $rs=$orden_servicio->save();
	 return $rs > 0 ? 'true' : 'false';
 } catch (Exception $e) {
 	Excepciones::Crear($e,'OrdenServicio','Modificar');
 } 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $orden_servicio=OrdenServicio::find($id);
 $rs=$orden_servicio->delete();
 
 }
 
 
public function ObtenerPorCodigo(){
 
try {

	$key=Input::get('key');
		
	$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);

	 $orden_servicio=OrdenServicio::find($obj['id_orden']);

	 $arrayList=array();

 	 $detalle=[];

 		foreach (HistorialCompra::where('ID_ORDEN_SERVICIO','=',$obj['id_orden'])->where('ESTADO','=','1')->get() as $hist) {
 			$detalle[]=array(
 				'id'=>$hist->ID,
 				'id_orden_servicio'=>$hist->ID_ORDEN_SERVICIO,
 				'fecha'=>$orden_servicio->PROG_FECHA,
 				'producto'=>$hist->producto_proveedor->PRODUCTOS_OFRECIDOS . ' ' . $hist->producto_proveedor->producto->NOMBRE,
 				'unidades'=>$hist->producto_proveedor->unidad->NOMBRE,
 				'proveedor'=>$hist->producto_proveedor->proveedor->NOMBRE,
 				'cantidad'=>$hist->CANTIDAD_COMPRADOS,
 				'valor'=>$hist->PRECIO 				
 			);
 		}

 		$arrayList=array(
 			'id'=>$orden_servicio->ID, 			
 			'estado'=>$orden_servicio->estado_entrega->NOMBRE,
 			'direccion'=>$orden_servicio->barriopersona->DIRECCION,
 			'fecha_compra'=>date('Y-m-d',strtotime($orden_servicio->FECHA_CREACION)),
 			'fecha_entrega'=>date('Y-m-d',strtotime($orden_servicio->PROG_FECHA)), 
 			'id_usuario'=>$orden_servicio->ID_USUARIO,	
 			'total'=>(double)$orden_servicio->Total(),
 			'convenio'=>(double)$orden_servicio->Convenio(),
 			'descuentobono'=>(double)$orden_servicio->DescuentoBono(),
 			'domicilio'=>(double)$orden_servicio->VALOR_DOMICILIO,		
 			'detalle'=>$detalle
 		);
 	
 	return $arrayList;

 	} catch (Exception $e) {
 		Excepciones::Crear($e,'OrdenServicio','ObtenerPoID');
 		return $e;
 	}
 
 }

 
public function ObtenerTodos(){
 
 return OrdenServicio::all()->toJSON();
 
 }

 public function ObtenerLosUltimosTres(){
 	
 	try {
 		 $id_user=Cookie::get('id_user');

	 $lista=OrdenServicio::where('ID_USUARIO','=',$id_user)->orderBy('ID', 'desc')->take(3)->get();

	 $arrayList=array();

 	foreach ($lista as $key => $row) {

 		$detalle=[];
 		$listahistorial=HistorialCompra::where('ID_ORDEN_SERVICIO','=',$row->ID)->where('ESTADO','=','1')->get();
 		foreach ($listahistorial as $hist) {
 			$detalle[]=array(
 				'id'=>$hist->ID,
 				'id_producto_proveedor'=>$hist->ID_PRODUCTO_PROVEEDOR,
 				'descripcion'=>$hist->DESCRIPCION,
 				'producto'=>$hist->PRODUCTO,
 				'cantidad'=>$hist->CANTIDAD_COMPRADOS,
 				'imagen'=>$this->rutaImagen . $hist->producto_proveedor->ARCHIVO_FOTO
 			);
 		}

 		$arrayList[]=array(
 			'id'=>$row->ID,
 			'fecha_orden'=>date('Y-m-d',strtotime($row->FECHA_CREACION)),
 			'estado'=>$row->estado_entrega->NOMBRE,
 			'total'=>$row->Total() - $row->Convenio() - $row->DescuentoBono(),
 			'detalle'=>$detalle
 		);
 	}

 	return $arrayList;

 	} catch (Exception $e) {
 		Excepciones::Crear($e,'OrdenServicio','ObtenerLosUltimosTres');
 	}
	
 
 }
 
 public function ObtenerPorCriterios(){
 	try {
 	$id_user=Cookie::get('id_user');
 	$opcion=Input::get('opcion'); 	
 	$año=date("Y");
 	$mes_actual=date('m');


 	$consulta=OrdenServicio::where('ID_USUARIO','=',$id_user);
 	$lista=array();

 	if ($opcion==1) {
 		$rs=DB::table('orden_servicio')
 		->select(DB::raw('MONTH(MAX(FECHA_CREACION)) as mes'))
 		->where('ID_USUARIO','=',$id_user)
 		->where(DB::raw('YEAR(FECHA_CREACION)'),'=',$año)->get();

 		if (isset($rs[0]->mes)) {
 			$lista=$consulta->where(DB::raw('YEAR(FECHA_CREACION)'),'=',$año)
 			->where(DB::raw('MONTH(FECHA_CREACION)'),'=',$rs[0]->mes)->orderBy('id','DESC')->get();
 		}
 		
 	}
 	elseif ($opcion==2) {
 		
 		$fecha_inical=date('Y-m-1', strtotime('-3 month'));
 		$fecha_final=date('Y-m-d');
 		
 		$lista=$consulta->where('FECHA_CREACION','>=',$fecha_inical)
 		->where('FECHA_CREACION','<=',$fecha_final)
 		->orderBy('id','DESC')->get();	

 	}
 	elseif ($opcion==3) {
 		
 		$fecha_inical=date('Y-m-1', strtotime('-6 month'));
 		$fecha_final=date('Y-m-d');
 		
 		$lista=$consulta->where('FECHA_CREACION','>=',$fecha_inical)
 		->where('FECHA_CREACION','<=',$fecha_final)
 		->orderBy('id','DESC')->get();	

 	}
 	elseif ($opcion==4) {
 		 		
 		$lista=$consulta
 		->orderBy('id','DESC')->get();	

 	}
 	elseif ($opcion > 2000) {
 		
 		$lista=$consulta->where(DB::raw('YEAR(FECHA_CREACION)'),'=',$opcion)
 		->orderBy('id','DESC')->get();		

 	}

 	$arrayList=array();

 	foreach ($lista as $key => $row) {

 		$detalle=[];
 		$listahistorial=HistorialCompra::where('ID_ORDEN_SERVICIO','=',$row->ID)->where('ESTADO','=','1')->get();
 		foreach ($listahistorial as $hist) {
 			$detalle[]=array(
 				'id'=>$hist->ID,
 				'id_producto_proveedor'=>$hist->ID_PRODUCTO_PROVEEDOR,
 				'descripcion'=>$hist->DESCRIPCION,
 				'producto'=>$hist->PRODUCTO,
 				'cantidad'=>$hist->CANTIDAD_COMPRADOS,
 				'imagen'=>$this->rutaImagen . $hist->producto_proveedor->ARCHIVO_FOTO
 			);
 		}

 		$arrayList[]=array(
 			'id'=>$row->ID,
 			'fecha_orden'=>date('Y-m-d',strtotime($row->FECHA_CREACION)),
 			'estado'=>$row->estado_entrega->NOMBRE,
 			'total'=>$row->Total()- $row->Convenio() - $row->DescuentoBono(),
 			'detalle'=>$detalle
 		);
 	}

 	 	return $arrayList;	
 	} catch (Exception $e) {
 		Excepciones::Crear($e,'OrdenServicio','ObtenerPorCriterios');
 	}	

 }


//pagos en linea

 public function PagoTarjetaCredito($item){

		if (!Session::has('usuario')) {
		 	$usuario=Usuario::find(Cookie::get('id_user'));
		 	Session::put('usuario',$usuario);
		}	
		
			PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
			$usuario=Session::get('usuario');
			$dir=BarrioPersona::find(Session::get('id_direccion'));
			$direccion=$dir ? $dir->DIRECCION : '';

			$reference = "mercafresco_pago_" . substr('0000000'.$item->ID,-8);
			$value = $item->Total() - ($item->Convenio() + $item->DescuentoBono());
			$num=(int)substr(Input::get('tarjeta'), 0,2);
			$tarjeta='';
			//51 y 55

			//dinner http://www.iteramos.com/pregunta/2263/como-se-puede-detectar-el-tipo-de-tarjeta-de-credito-basadas-en-el-numero
			//PaymentMethods::VISA||PaymentMethods::MASTERCARD||PaymentMethods::AMEX||PaymentMethods::DINERS
			if ($num >= 40 && $num < 50) {
				$tarjeta=PaymentMethods::VISA;
			}elseif ($num >= 51 && $num <=55) {
				$tarjeta=PaymentMethods::MASTERCARD;
			}elseif ($num==3) {
				$tarjeta=PaymentMethods::AMEX;
			}

			$parameters = array(
			//Ingrese aquí el identificador de la cuenta.
			PayUParameters::ACCOUNT_ID => "532774",//"500538",
			//Ingrese aquí el código de referencia.
			PayUParameters::REFERENCE_CODE => $reference,
			//Ingrese aquí la descripción.
			PayUParameters::DESCRIPTION => "Compras de productos Mercafresco.",
			
			// -- Valores --
			//Ingrese aquí el valor.        
			PayUParameters::VALUE => $value,
			//Ingrese aquí la moneda.
			PayUParameters::CURRENCY => "COP",			
			
			// -- Comprador 
			//Ingrese aquí el nombre del comprador.
			PayUParameters::BUYER_NAME => $usuario->persona->NOMBRES . ' ' . $usuario->persona->APELLIDOS,
			//Ingrese aquí el email del comprador.
			PayUParameters::BUYER_EMAIL => $usuario->persona->EMAIL,
			//Ingrese aquí el teléfono de contacto del comprador.
			PayUParameters::BUYER_CONTACT_PHONE => $usuario->persona->TELEFONO,
			//Ingrese aquí el documento de contacto del comprador.
			PayUParameters::BUYER_DNI => $usuario->persona->NO_IDENTIFICACION,
			//Ingrese aquí la dirección del comprador.
			PayUParameters::BUYER_STREET => $direccion,
			PayUParameters::BUYER_STREET_2 => "",
			PayUParameters::BUYER_CITY => "Barranquilla",
			PayUParameters::BUYER_STATE => "Barranquilla",
			PayUParameters::BUYER_COUNTRY => "CO",
			PayUParameters::BUYER_POSTAL_CODE => "000000",
			PayUParameters::BUYER_PHONE => $usuario->persona->CELULAR,
			
			// -- pagador --
			//Ingrese aquí el nombre del pagador.
			PayUParameters::PAYER_NAME =>Input::get('nombre'),// 'APPROVED'
			//Ingrese aquí el email del pagador.
			PayUParameters::PAYER_EMAIL => $usuario->persona->EMAIL,
			//Ingrese aquí el teléfono de contacto del pagador.
			PayUParameters::PAYER_CONTACT_PHONE => $usuario->persona->TELEFONO,
			//Ingrese aquí el documento de contacto del pagador.
			PayUParameters::PAYER_DNI => $usuario->persona->NO_IDENTIFICACION,
			//Ingrese aquí la dirección del pagador.
			PayUParameters::PAYER_STREET => $direccion,
			PayUParameters::PAYER_STREET_2 => "",
			PayUParameters::PAYER_CITY => "Barranquilla",
			PayUParameters::PAYER_STATE => "Barranquilla",
			PayUParameters::PAYER_COUNTRY => "CO",
			PayUParameters::PAYER_POSTAL_CODE => "000000",
			PayUParameters::PAYER_PHONE => $usuario->persona->CELULAR,
			
			// -- Datos de la tarjeta de crédito -- 
			//Ingrese aquí el número de la tarjeta de crédito
			PayUParameters::CREDIT_CARD_NUMBER => Input::get('tarjeta'),
			//Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
			PayUParameters::CREDIT_CARD_EXPIRATION_DATE => Input::get('ano') . '/' . Input::get('mes'),
			//Ingrese aquí el código de seguridad de la tarjeta de crédito
			
			//PayUParameters::PROCESS_WITHOUT_CVV2 => true,

			PayUParameters::CREDIT_CARD_SECURITY_CODE=> Input::get('codigo_seguridad'),
			//Ingrese aquí el nombre de la tarjeta de crédito
			//PaymentMethods::VISA||PaymentMethods::MASTERCARD||PaymentMethods::AMEX||PaymentMethods::DINERS
			PayUParameters::PAYMENT_METHOD => $tarjeta,//PaymentMethods::MASTERCARD,
			
			//Ingrese aquí el número de cuotas.
			PayUParameters::INSTALLMENTS_NUMBER => Input::get('numero_cuotas'),
			//Ingrese aquí el nombre del pais.
			PayUParameters::COUNTRY => PayUCountries::CO,
			
			//Session id del device.
			PayUParameters::DEVICE_SESSION_ID => Session::getId(),
			//IP del pagadador
			PayUParameters::IP_ADDRESS => Request::getClientIp(),
			//Cookie de la sesión actual.
			PayUParameters::PAYER_COOKIE=>Cookie::get('laravel_session'),
			//Cookie de la sesión actual.        
			PayUParameters::USER_AGENT=>$_SERVER['HTTP_USER_AGENT']//"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
		);
			
		$response = PayUPayments::doAuthorizationAndCapture($parameters);
		
		return $response;
			
}


public function PagoTransferenciasBancarias($item){
	
	if (!Session::has('usuario')) {
	 	$usuario=Usuario::find(Cookie::get('id_user'));
	 	Session::put('usuario',$usuario);
	}
	Session::put('nombre_pagador',Input::get('nombre'));
	Session::put('id_banco',Input::get('id_banco'));
	Session::put('telefono',Input::get('telefono'));
	PayU::$isTest = false;
	$usuario=Session::get('usuario');
	$reference = "mercafresco_pago_" . substr('0000000'.$item->ID,-8);
	$value = $item->Total() - ($item->Convenio() + $item->DescuentoBono());

	$parameters = array(
	//Ingrese aquí el identificador de la cuenta.
	PayUParameters::ACCOUNT_ID => "532774",//"500538",
	//Ingrese aquí el código de referencia.
	PayUParameters::REFERENCE_CODE => $reference,
	//Ingrese aquí la descripción.
	PayUParameters::DESCRIPTION => "Compras de productos Mercafresco.",
	
	// -- Valores --
	//Ingrese aquí el valor.        
	PayUParameters::VALUE => $value,
	//Ingrese aquí la moneda.
	PayUParameters::CURRENCY => "COP",
	
	//Ingrese aquí el email del comprador.
	PayUParameters::BUYER_EMAIL => $usuario->persona->EMAIL,
	//Ingrese aquí el nombre del pagador.
	PayUParameters::PAYER_NAME => Input::get('nombre'),
	//Ingrese aquí el email del pagador.
	PayUParameters::PAYER_EMAIL => $usuario->persona->EMAIL,
	//Ingrese aquí el teléfono de contacto del pagador.
	PayUParameters::PAYER_CONTACT_PHONE=> $usuario->persona->TELEFONO,
		   
	// -- infarmación obligatoria para PSE --
	//Ingrese aquí el código pse del banco.
	PayUParameters::PSE_FINANCIAL_INSTITUTION_CODE => Input::get('id_banco'),
	//Ingrese aquí el tipo de persona (N natural o J jurídica)
	PayUParameters::PAYER_PERSON_TYPE => "N",
	//Ingrese aquí el documento de contacto del pagador.
	PayUParameters::PAYER_DNI => Input::get('cedula'),
	//Ingrese aquí el tipo de documento del pagador: CC, CE, NIT, TI, PP,IDC, CEL, RC, DE.
	PayUParameters::PAYER_DOCUMENT_TYPE => "CC",

	//Ingrese aquí el nombre del método de pago
	PayUParameters::PAYMENT_METHOD => PaymentMethods::PSE,
   
	//Ingrese aquí el nombre del pais.
	PayUParameters::COUNTRY => PayUCountries::CO,
	
	//IP del pagadador
	PayUParameters::IP_ADDRESS => Request::getClientIp(),
	//Cookie de la sesión actual.
	PayUParameters::PAYER_COOKIE=>Cookie::get('laravel_session'),
	//Cookie de la sesión actual.        
	PayUParameters::USER_AGENT=>$_SERVER['HTTP_USER_AGENT'],
	
	//Página de respuesta a la cual será redirigido el pagador.     
	PayUParameters::RESPONSE_URL=>Request::root()."/ordenservicio/respuestadelbanco"
	
);
	
$response = PayUPayments::doAuthorizationAndCapture($parameters);

return $response;	

}

public function GuardarUsuarioCupon($codigo){
try {
	
	$id_user=Cookie::get('id_user');
	$bono=Bonos::whereRaw("lower(CODIGO)='".strtolower($codigo)."'")->first();	

	$id=0;
	if ($bono) {

		$horas=Funciones::RestarFechas(date('Y/m/d'),date('Y/m/d',strtotime($bono->FECHA_FINAL)));

		if ($horas < 0) {
			return array('show'=>true,'alert'=>'warning','msg'=>'Este cupon ya esta vencido.');
		}

		//$usubono=UsuarioBono::whereRaw('ID_USUARIO=? and ID_BONO=? and ',array($id_user,$bono->ID))->first();
		if ($bono->ID_CARACTERISICA_BONO==1/*PRIMERA COMPRA*/) {

			$compras=OrdenServicio::where('ID_USUARIO','=',$id_user)->count();
			$usubono=UsuarioBono::whereRaw('ID_USUARIO=? and ID_BONO=? ',array($id_user,$bono->ID))->first();

			if ($compras > 0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Este cupon es solo para la primera compra.');
			}
			if ($usubono) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El cupon ya fué utilizado.');
			}
		}

		if ($bono->ID_CARACTERISICA_BONO==2/*CUPON UNICO*/) {

			$usubono=UsuarioBono::whereRaw('ID_USUARIO=? and ID_BONO=? ',array($id_user,$bono->ID))->first();

			if ($usubono) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Ya ha utilizado este cupón.');
			}
		}

		if ($bono->ID_CARACTERISICA_BONO==3/*CUPON LIBRE*/) {
			
			$usubono=UsuarioBono::whereRaw('ID_USUARIO=? and ID_BONO=? and USADO=0',array($id_user,$bono->ID))->first();

			if ($usubono) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Cupón guardado correctamente.');//Ya tiene un cupon de este tipo sin usar..
			}
		}
				
		$rs=UsuarioBono::create(array(
			'ID_USUARIO'=>$id_user,
			'ID_BONO'=>$bono->ID,
			'USADO'=>0	,
			'FECHA_INGRESO'=>DB::raw('NOW()')
			));

		if ($rs['ID_BONO']>0) {
			return array('show'=>true,'alert'=>'success','msg'=>'Cupon guardado correctamente.');	
		}else{
			return array('show'=>true,'alert'=>'warning','msg'=>'Error al guardar cupon.');	
		}
		
	}else{
		return array('show'=>true,'alert'=>'warning','msg'=>'No existe un cupón con este nombre, verifíquelo e intente nuevamente.');	
	}

	return array('show'=>true,'alert'=>'danger','msg'=>'Error al guardar cupon.');

	} catch (Exception $e) {
		Excepciones::Crear($e,'OrdenServicio','GuardarUsuarioCupon');
		return array('show'=>true,'alert'=>'danger','msg'=>'Error al guardar cupon.');
	}	

}


public function HecerReembolsoPorExecpcion($id_orden, $id_transaccion){
	try {

		PayU::$isTest = false;

		$parameters = array(

		//Ingrese aquí el identificador de la orden.
		PayUParameters::ORDER_ID => $id_orden,

		//Ingrese aquí el identificador de la transacción.
		PayUParameters::TRANSACTION_ID => $id_transaccion,

		//Ingrese aquí el motivo del reembolso.
		PayUParameters::REASON => "Hubo una excepcion en el proceso de pago",
		);

		//PayUPayments::doRefund($parameters);
		$response = PayUPayments::doVoid($parameters);

		/*if ($response) {
			$response->transactionResponse->orderId;
			$response->transactionResponse->state;
			$response->transactionResponse->pendingReason;
			$response->transactionResponse->responseMessage; 
		}*/

	} catch (Exception $e) {
		
	}
}

public function RespuestaDelBanco(){
	try {


		$item=Session::get('OrderServicio');
		Session::get('nombre_pagador');
	    Session::get('id_banco');
	    Session::get('telefono');
	   if (Input::get('polTransactionState')==6 && Input::get('polResponseCode')==4) {

	   		$item->ID_TRANSACCION=Input::get('transactionId');			
			$item->ESTADO_TRANSACCION= 'REJECTED';
			$item->CODIGO_RESPUESTA= Input::get('lapResponseCode');			
	   		$item->ID_ESTADO_PAGO=3;
	   		$item->save();	 
	   		
	   		Session::put('respuestabanco',array('ID'=>0,'msg'=>'Lo sentimos su transacción fue rechazada.'));
	   		return Redirect::to(Request::root().'/#/respuesta-banco/'.Input::get('pseReference3').'/'.Session::get('nombre_pagador').
	   			'/'.Session::get('id_banco').'/'. Session::get('telefono'));

	   }elseif (Input::get('polTransactionState')==6 && Input::get('polResponseCode')==5) {
	   		$item->ID_TRANSACCION=Input::get('transactionId');			
			$item->ESTADO_TRANSACCION= 'ERROR';
			$item->CODIGO_RESPUESTA= Input::get('lapResponseCode');
			$item->RAZON_PENDIENTE=  '';
	   		$item->ID_ESTADO_PAGO=4;
	   		$item->save();	 
	   		Session::put('respuestabanco',array('ID'=>0,'msg'=>'Lo sentimos ocurrio un error.'));
	   		return Redirect::to(Request::root().'/#/respuesta-banco/'.Input::get('pseReference3').'/'.Session::get('nombre_pagador').
	   			'/'.Session::get('id_banco').'/'. Session::get('telefono'));

	   }elseif (Input::get('polTransactionState')==12 && Input::get('polResponseCode')==9994) {
	   		$item->ID_TRANSACCION=Input::get('transactionId');
			$item->ESTADO_TRANSACCION= 'PENDING';
			$item->CODIGO_RESPUESTA= Input::get('lapResponseCode');
			$item->RAZON_PENDIENTE=  'Transacción pendiente, por favor revisar si el débito fue realizado en el banco.';
	   		$item->ID_ESTADO_PAGO=6;
	   		$item->save();	 
	   		Session::put('respuestabanco',array('ID'=>0,'msg'=>'Transacción pendiente, por favor revisar si el débito fue realizado en el banco.'));
	   		return Redirect::to(Request::root().'/#/respuesta-banco/'.Input::get('pseReference3').'/'.Session::get('nombre_pagador').
	   			'/'.Session::get('id_banco').'/'. Session::get('telefono'));

	   }else if (Input::get('polTransactionState')==4 && Input::get('polResponseCode')==1) {

	   		$id_user=Cookie::get('id_user');
			$usuario=Usuario::find($id_user);
	   		
	   		$item->ID_TRANSACCION=Input::get('transactionId');
			$item->ESTADO_TRANSACCION= 'APPROVED';
			$item->CODIGO_RESPUESTA= Input::get('lapResponseCode');			
	   		$item->ID_ESTADO_PAGO=2;
	   		$item->save();	
	   		
	   		$data=array(
		 		'id'=>$item->ID,
				'cliente'=>$usuario->persona->NOMBRES . ' ' . $usuario->persona->APELLIDOS,
				'celular'=>$usuario->persona->CELULAR,
				'telefono'=>$usuario->persona->TELEFONO,
				'formapago'=>$item->tipometodopago->NOMBRE,
				'fechapago'=>$item->PROG_FECHA,
				'barrio'=>$item->barriopersona->barrio->NOMBRE,
				'direccion'=>$item->barriopersona->DIRECCION,
				'recibe'=>$item->barriopersona->QUIEN_RECIBE,
				'productos'=>$item->CantidadProductos(),
				'domicilio'=>$item->VALOR_DOMICILIO,
				'total'=>$item->Total(),
				'convenio'=>(double)$item->Convenio(),
				'descuentobono'=>(double)$item->DescuentoBono()
		 	);

	   		Mail::send('plantilla_correo/crear_pedido', $data, function($message){
		 		$id_user=Cookie::get('id_user');
				$usuario=Usuario::find($id_user);
		 		$id_orden=Session::get('id_orden');
		 		$email=$usuario->persona->EMAIL;
		 		$cliente=$usuario->persona->NOMBRES.' '.$usuario->persona->APELLIDOS;
				$message->to($email, $cliente)->subject('Pedido No. '.$id_orden.' realizado correctamente');
			});

	   		DB::commit();
	   		Session::forget('OrderServicio');

	   		return Redirect::to(Request::root().'/#/finalizar');

	   }

	   //return Input::get('transactionId');

	} catch (Exception $e) {
		return $e;
	}
}

public function ReintertarPagoBancario(){
	try {

		$item=Session::get('OrderServicio');

		$this->PagoTransferenciasBancarias($item);

		$respuesta=$this->PagoTransferenciasBancarias($item);
		
		$item->ID_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->transactionId : DB::raw('NULL');
		$item->ID_ORDEN_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->orderId : DB::raw('NULL');
		$item->ESTADO_TRANSACCION= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->state : DB::raw('NULL');
		$item->CODIGO_RESPUESTA= $respuesta->transactionResponse!=null ? $respuesta->transactionResponse->responseCode : DB::raw('NULL');
		$item->RAZON_PENDIENTE=  $respuesta->transactionResponse!=null && $respuesta->transactionResponse->state=='PENDING' ? $respuesta->transactionResponse->pendingReason : DB::raw('NULL');
	   	$item->ID_ESTADO_PAGO=5;
	   	$item->save();

	   	return $respuesta->transactionResponse->extraParameters->BANK_URL;

	} catch (Exception $e) {
		return $e;
	}	
}

	public function TerminarProcesoDePagoBancario(){
		DB::beginTransaction();
		try {
			
			$item=Session::get('OrderServicio');
			$historial=HistorialCompra::where('ID_ORDEN_SERVICIO','=',$item->ID)->get();
			foreach ($historial as $key => $row) {
				$producto_proveedor=ProductosProveedor::find($row->ID_PRODUCTO_PROVEEDOR);
				$producto_proveedor->INVENTARIO=$producto_proveedor->INVENTARIO + $row->CANTIDAD_COMPRADOS;
				$producto_proveedor->save();
			}

			HistorialCompra::where('ID_ORDEN_SERVICIO','=',$item->ID)->delete();

			$item->delete();

			DB::commit();
			return 'success';

		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'OrdenServicio','TerminarProcesoDePagoBancario');
			return array('ID'=>0,'msg'=>$e->getMessage());	
		}		

	}

	public function EnviarCorreo(){
		DB::beginTransaction();
		try {
			
			$lista=OrdenServicio::where('MENSAJE_ENVIADO','=',0)
			->where('ID_ESTADO_PAGO','<>',1/*por pagar*/)
			->where('ID_TIPO_METODO_PAGO','<>',enTipoMetodoPago::PSE)->get();

			if (count($lista)>0) {
				foreach ($lista as $key => $item) {
					
					$data=array(
				 		'id'=>$rs["ID"],
						'cliente'=>$usuario->persona->NOMBRES . ' ' . $usuario->persona->APELLIDOS,
						'celular'=>$usuario->persona->CELULAR,
						'telefono'=>$usuario->persona->TELEFONO,
						'formapago'=>$item->tipometodopago->NOMBRE,
						'fecha_envio'=>$item->PROG_FECHA,
						'barrio'=>$item->barriopersona->barrio->NOMBRE,
						'direccion'=>$item->barriopersona->DIRECCION,
						'recibe'=>$item->barriopersona->QUIEN_RECIBE,
						'productos'=>$item->CantidadProductos(),
						'domicilio'=>$item->VALOR_DOMICILIO,
						'total'=>$item->Total(),
						'convenio'=>(double)$item->Convenio(),
						'descuentobono'=>(double)$item->DescuentoBono()
				 	);

					Mail::send('plantilla_correo/crear_pedido', $data, function($message){
				 		$usuario=Session::get('usuario');
				 		$id_orden=Session::get('id_orden');
				 		$email=$usuario->persona->EMAIL;
				 		$cliente=$usuario->persona->NOMBRES.' '.$usuario->persona->APELLIDOS;
				 		$message->bcc('contacto@mercafresco.co', $name = null);
						$message->to($email, $cliente)->subject('Pedido No. '.$id_orden.' realizado correctamente');
					});

				}
			}

			DB::commit();

		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'OrdenServicio','TerminarProcesoDePagoBancario');
		}
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