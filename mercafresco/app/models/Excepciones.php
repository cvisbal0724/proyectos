<?php

class Excepciones extends \Eloquent {
	
	protected $table = 'excepciones';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;


	public static function Crear($EXCEPCION, $CONTROLADOR, $METODO){
		try {

			$ID_USUARIO=0;
			if (Session::has('usuario')) {
				$usuario=Session::get('usuario');
				$ID_USUARIO=$usuario->ID;
			}			

			Excepciones::create(array(
				'EXCEPCION'=>$EXCEPCION,
				'ID_USUARIO'=>$ID_USUARIO,
				'FECHA'=>DB::raw('NOW()'),
				'CONTROLADOR'=>$CONTROLADOR,
				'METODO'=>$METODO,
				'MENSAJE'=>$EXCEPCION->getMessage(),
				'ENVIADO'=>0
			));
			
		} catch (Exception $e) {
			//return $e;
		}
	}

}