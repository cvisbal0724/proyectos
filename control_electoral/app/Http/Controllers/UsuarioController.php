<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Execepciones;
use App\models\Personas;
use App\models\Usuarios;

class UsuarioController extends Controller {

	public function Crear(Request $request){
		try {
			
			$rs=Usuarios::create(array(
				'usuario'=>$request->input('usuario'),
				'password'=>Hash::make('12345'),
				'id_persona'=>$request->input('id_persona'),
				'id_perfil'=>$request->input('id_perfil'),
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Usuario guardado satisfactoriamente.','data'=>Alcaldes::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el usuario.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'UsuarioController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}


	

}
