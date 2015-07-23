<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\models\Excepciones;

class Excepciones extends Model {

	protected $table = 'excepciones';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

	public static function Crear($excepcion, $controlador, $metodo){
		try {

			$id_usuario=0;
			if (Auth::check()) {
				$usuario=Auth::User();
				$id_usuario=$usuario->ID;
			}			

			Excepciones::create(array(
				'excepcion'=>$excepcion,
				'id_usuario'=>$id_usuario,
				'controlador'=>$controlador,
				'metodo'=>$metodo,
				'mensaje'=>$excepcion->getmessage(),
				'enviado'=>0
			));
			
		} catch (Exception $e) {
			//return $e;
		}
	}

}
