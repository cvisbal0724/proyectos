<?php


class OrdenServicioController extends BaseController {

public function Crear(){

	if (!Session::has('id_direccion') || !Session::has('hora') || !Session::has('fecha')) {
		return array('ID'=>0,'msg'=>'Por favor selecciones la hora en la que desea la entrega de su pedido.');	
	}	
	else{

	DB::beginTransaction();
	
	try {
	
	$id_user=Cookie::get('id_user');
	$usuario=Usuario::find($id_user);
	Session::put('usuario',$usuario);
	$empresaconvenio=null;
    $cedula=$usuario->persona->NO_IDENTIFICACION;
   
	$funcionario=Funcionario::where('CEDULA','=',$cedula)->first();
	
	$rs=OrdenServicio::create(array(
	  
	"ID_TIPO_METODO_PAGO"=>Input::get('id_metodo_pago'),	
	"ID_BARRIO_PERSONA"=>Session::get('id_direccion'),
	"ID_BONO"=>DB::raw('NULL'),
	"PROG_FECHA"=>Session::get('fecha'),
	"PROG_HORA"=>Session::get('hora'),
	//"FECHA_ENTREGA"=>Input::get("fecha_entrega"),
	"VALOR_DOMICILIO"=>0,
	"ID_PROVEEDOR"=>1,
	"FECHA_CREACION"=>DB::raw('NOW()'),
	"ID_USUARIO"=>$id_user,
	"ID_ESTADO_ENTREGA"=>1,
	"ESTADO"=>1,
	"ID_ESTADO_PAGO"=>1		
	));
 	
 	
 	$listaTempComp=TemporalCompra::where('ID_USUARIO','=', $id_user)->get();

 	if ($rs["ID"]>0 && count($listaTempComp)>0) {

 		foreach ($listaTempComp as $key => $item) {

 			$prodProv=ProductosProveedor::find($item->ID_PRODUCTO_PROVEEDOR);

 			if ($funcionario) {

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
 				'IVA_TASA' =>0,
 				'FECHA_CREACION'=> DB::raw('NOW()'),
 				'ESTADO'=>0,
 				'ID_PRODUCTO_PROVEEDOR'=>$item->ID_PRODUCTO_PROVEEDOR,
 				'ID_EMPRESA_CONVENIO'=>$empresaconvenio!=NULL ? $empresaconvenio->ID : DB::raw('NULL') 
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
		'fechapago'=>$item->PROG_FECHA,
		'barrio'=>$item->barriopersona->barrio->NOMBRE,
		'direccion'=>$item->barriopersona->DIRECCION,
		'recibe'=>$item->barriopersona->QUIEN_RECIBE,
		'productos'=>$item->CantidadProductos(),
		'domicilio'=>$item->VALOR_DOMICILIO,
		'total'=>$item->Total(),
		'convenio'=>$item->Convenio()
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
	   		$item->save();
	   }
	}
 	


 	/*Mail::send('orden/orden', $data, function($message){
 		$usuario=Session::get('usuario');
 		$email=$usuario->persona->EMAIL;
 		$cliente=$usuario->persona->NOMBRES.' '.$usuario->persona->APELLIDOS;
		$message->to($email, $cliente)->subject('Detalle de pedido');
	});*/

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
			'recibe'=>strtolower($item->barriopersona->QUIEN_RECIBE),
			'dia'=>$item->PROG_FECHA,
			'hora'=>$Horas[$item->PROG_HORA],			
			'recibe'=>strtolower($item->barriopersona->QUIEN_RECIBE),
			'productos'=>$item->CantidadProductos(),
			'domicilio'=>$item->VALOR_DOMICILIO,
			'email'=>strtolower($usuario->persona->EMAIL),
			'convenio'=>$item->Convenio()
			
		);

		//Session::forget('id_orden');
		Session::forget('id_direccion');
		Session::forget('hora');
		Session::forget('fecha');
		return $lista;

	}
		
	} catch (Exception $e) {
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
 
 
public function ObtenerPoID(){
 
 $id=Input::get("id");
 return OrdenServicio::find($id)->toJSON();
 
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

 		foreach (HistorialCompra::where('ID_ORDEN_SERVICIO','=',$row->ID)->get() as $hist) {
 			$detalle[]=array(
 				'id'=>$hist->ID,
 				'id_producto_proveedor'=>$hist->ID_PRODUCTO_PROVEEDOR,
 				'descripcion'=>$hist->producto_proveedor->DESCRIPCION,
 				'cantidad'=>$hist->CANTIDAD_COMPRADOS,
 				'imagen'=>$hist->producto_proveedor->ARCHIVO_FOTO
 			);
 		}

 		$arrayList[]=array(
 			'id'=>$row->ID,
 			'fecha_orden'=>date('Y-m-d',strtotime($row->FECHA_CREACION)),
 			'estado'=>$row->estado_entrega->NOMBRE,
 			'total'=>$row->Total() - $row->Convenio(),
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

 		foreach (HistorialCompra::where('ID_ORDEN_SERVICIO','=',$row->ID)->get() as $hist) {
 			$detalle[]=array(
 				'id'=>$hist->ID,
 				'id_producto_proveedor'=>$hist->ID_PRODUCTO_PROVEEDOR,
 				'descripcion'=>$hist->producto_proveedor->DESCRIPCION,
 				'cantidad'=>$hist->CANTIDAD_COMPRADOS,
 				'imagen'=>$hist->producto_proveedor->ARCHIVO_FOTO
 			);
 		}

 		$arrayList[]=array(
 			'id'=>$row->ID,
 			'fecha_orden'=>date('Y-m-d',strtotime($row->FECHA_CREACION)),
 			'estado'=>$row->estado_entrega->NOMBRE,
 			'total'=>$row->Total()-$item->Convenio(),
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

		if (Session::has('usuario')) {
		 	
			PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
			$usuario=Session::get('usuario');
			$dir=BarrioPersona::find(Session::get('id_direccion'));
			$direccion=$dir ? $dir->DIRECCION : '';

			$reference = "mercafresco_pago_" . $item->ID;
			$value = $item->Total()-$item->Convenio();
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
			PayUParameters::ACCOUNT_ID => "500538",
			//Ingrese aquí el código de referencia.
			PayUParameters::REFERENCE_CODE => $reference,
			//Ingrese aquí la descripción.
			PayUParameters::DESCRIPTION => "Compras de productos mercafresco.",
			
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
			PayUParameters::PAYER_NAME => 'APPROVED',//Input::get('nombre'),
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
			PayUParameters::PAYMENT_METHOD => PaymentMethods::VISA,
			
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
 	
}


public function HecerReembolsoPorExecpcion($id_orden, $id_transaccion){
	try {

		PayU::$isTest = true;

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

public function PagoTransferenciasBancarias(){

}

public function GuardarUsuarioCupon($codigo){

try {
	
		$id_user=Cookie::get('id_user');
	$bono=Bonos::whereRaw("lower(CODIGO)='".strtolower($codigo)."'")->first();	

	$id=0;
	if ($bono) {

		$usubono=UsuarioBono::where('ID_USUARIO','=',$id_user)->where('ID_BONO','=',$bono->ID)->first();
		if ($usubono) {
			return array('show'=>true,'alert'=>'warning','msg'=>'El cupon ya existe, ingrese uno diferente.');
		}
		$rs=UsuarioBono::create(array(
			'ID_USUARIO'=>$id_user,
			'ID_BONO'=>$bono->ID,
			'USADO'=>0	,
			'FECHA_INGRESO'=>DB::raw('NOW()')
			));

		if ($rs['ID_BONO']>0) {
			return array('show'=>true,'alert'=>'success','msg'=>'Cupon guardado satisfactoriamente.');	
		}else{
			return array('show'=>true,'alert'=>'warning','msg'=>'Error al guardar cupon.');	
		}
		
	}else{
		return array('show'=>true,'alert'=>'warning','msg'=>'El cupon no existe.');	
	}

	return array('show'=>true,'alert'=>'danger','msg'=>'Error al guardar cupon.');

	} catch (Exception $e) {
		Excepciones::Crear($e,'OrdenServicio','GuardarUsuarioCupon');
		return array('show'=>true,'alert'=>'danger','msg'=>'Error al guardar cupon.');
	}	

}

}

