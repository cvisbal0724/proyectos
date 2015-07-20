<?php

class CalificanosController extends \BaseController {

	 public function Crear(){
	 	try {
	 		
	 		$key=Input::get('key');
		
			$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);
			$usuario=Usuario::find($obj['id_usuario']);
	 		$rs=CalificacionProveedor::create(array(
	 			'ID_PROVEEDOR'=>1,//$obj['id_proveedor'],
	 			'ID_USUARIO'=>$obj['id_usuario'],
	 			'ID_ORDEN_SERVICIO'=>$obj['id_orden'],
	 			'PUNTUACION'=>Input::get('puntuacion'),
	 			'COMENTARIO'=>Input::get('comentario'),
	 			'FECHA_CREACION'=>DB::raw('NOW()')
	 		));

	 		$data=array(
	 			'calificacion'=>Input::get('puntuacion'),
	 			'comentario'=>Input::get('comentario'),
	 			'cliente'=>$usuario->persona->Nombre_Completo()
	 		);
	 		Session::put('id_ord',$obj['id_orden']);
	 		Mail::send('plantilla_correo/correo_calificanos', $data, function($message){
	 			$message->bcc('cvisbal0724@gmail.com', $name = null);		 		
				$message->to('contacto@mercafresco.co', '')->subject('Pedido No. '.Session::get('id_ord').' calificado');
			});

	 		return $rs['ID'] > 0 ? 'success' : 'error';

	 	} catch (Exception $e) {
	 		Excepciones::Crear($e,'OrdenServicio','ObtenerPoID');
	 		return $e;
	 	}
	 }


	public function ObtenerCompraPorCodigo(){
	 
	try {

		$key=Input::get('key');
			
		$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);

		$horas=Funciones::RestarFechas(date('Y/m/d'),$obj['fecha']);

		if ($horas > 0) {
		
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
	 		
		}

		$calificacion=CalificacionProveedor::where('ID_ORDEN_SERVICIO','=',$orden_servicio->ID)->first();

		if ($calificacion!=null) {
			$cal=array(
				'id'=>$calificacion->ID,
				'comentario'=>$calificacion->COMENTARIO,
				'puntuacion'=>$calificacion->PUNTUACION);
			return array('orden'=>$arrayList,'calificacion'=>$cal);
		}

	 	return array('orden'=>$arrayList,'calificacion'=>array('id'=>0));

	 	} catch (Exception $e) {
	 		Excepciones::Crear($e,'OrdenServicio','ObtenerPoID');
	 		return $e;
	 	}
	 
	 }


}