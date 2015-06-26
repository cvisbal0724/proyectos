<?php

class PQRController extends \BaseController {

	public function Crear(){

		DB::beginTransaction();

	 	try {

		$rs=PQR::create(array(
			'ID_TIPO_PQR'=>Input::get('id_tipo_pqr'),
			'NOMBRES'=>Input::get('nombres'),
			'APELLIDOS'=>Input::get('apellidos'),
			'EMAIL'=>Input::get('email'),
			'TELEFONO'=>Input::get('telefono'),
			'COMENTARIO'=>Input::get('comentario'),
			'FECHA_CREACION'=>DB::raw('NOW()'),
			'ESTADO'=>1,
		));

		$pqr=PQR::find($rs['ID']);

		$data=array(			
			'nombre'=>$pqr->NOMBRES . ' ' . $pqr->APELLIDOS,			
			'correo'=>$pqr->EMAIL,
			'telefono'=>$pqr->TELEFONO,
			'comentario'=>$pqr->COMENTARIO,			
			'sujerencia'=>$pqr->tipopqr->NOMBRE
			);

		 Mail::send('mas_informacion/plantilla_pqr', $data, function($message){
		        $message->to('contacto@mercafresco.co', Input::get('nombres').' '.Input::get('apellidos'))->subject('Mensaje PQR');
		 });

		  /*Mail::send('mas_informacion/plantilla_pqr', $data, function($message){
		        $message->to('contacto@mercafresco.co', Input::get('nombres').' '.Input::get('apellidos'))->subject('Mensaje PQR');
		 });*/

		DB::commit();
		return $rs['ID'] > 0 ? array('alert'=>'success','msg'=>'Susugerencia fue enviada satisfactoriamente.','show'=>true) :
		array('alert'=>'danger','msg'=>'Su Susugerencia no pudo ser enviada estamos trabajando para mejorar nuestro servicio.','show'=>true);
		
		} catch (Exception $e) {
			DB::rollback();
			return array('alert'=>'danger','msg'=>$e->message,'show'=>true);					
	 	}
	}
}

