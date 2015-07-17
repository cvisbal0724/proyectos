<?php

class CalificanosController extends \BaseController {

	 public function Crear(){
	 	try {
	 		
	 		$key=Input::get('key');
		
			$obj=Encriptacion::decrypt($key, Encriptacion::ENCRYPTION_KEY);
			
	 		$rs=CalificacionProveedor::create(array(
	 			'ID_PROVEEDOR'=>$obj['id_proveedor'],
	 			'ID_USUARIO'=>$obj['id_usuario'],
	 			'ID_ORDEN_SERVICIO'=>$obj['id_orden'],
	 			'PUNTUACION'=>Input::get('puntuacion'),
	 			'COMENTARIO'=>Input::get('comentario'),
	 			'FECHA_CREACION'=>DB::raw('NOW()')
	 		));

	 		return $rs['ID'] > 0 ? 'success' : 'error';

	 	} catch (Exception $e) {
	 		Excepciones::Crear($e,'OrdenServicio','ObtenerPoID');
	 		return $e;
	 	}
	 }

}