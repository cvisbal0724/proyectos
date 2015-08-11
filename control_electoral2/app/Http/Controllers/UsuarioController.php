<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Execepciones;
use App\models\Personas;
use App\models\Usuarios;
use Hash;
use DB;
use Input;
use Cookie;

class UsuarioController extends Controller {

	public function Crear(){
		try {
			
			$usuario=Usuarios::where('usuario','=',Input::get('usuario'))->first();
			if ($usuario) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El usuario ya existe.');
			}
			$rs=Usuarios::create(array(
				'usuario'=>Input::get('usuario'),
				'password'=>Hash::make('12345'),
				'id_persona'=>Input::get('id_persona'),
				'id_perfil'=>Input::get('id_perfil'),
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Usuario guardado satisfactoriamente.','data'=>'') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el usuario.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'UsuarioController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Actualizar(){
			try {
					
				$usuario=Usuarios::find(Input::get('id'));
					
				$usuario->id_persona=Input::get('id_persona');
				$usuario->id_perfil=Input::get('id_perfil');
				$rs=$usuario->save();

				return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Usuario actualizado satisfactoriamente.','data'=>'') :
						array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el usuario.');

			} catch (Exception $e) {
				Excepciones::Crear($e,'UsuarioController','Actualizar');
				return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
			}
		}	

	public function Consultar(){
		
		$criterio=Input::get('criterio');
		$lista=array();
		$consulta=DB::table('usuarios as u')
			->join('personas as p','u.id_persona','=','p.id')
			->join('perfiles as pf','u.id_perfil','=','pf.id')
			->select('u.id','u.usuario','p.nombre','p.apellido','pf.nombre as perfil');
		$paginado=10;
		if ($criterio=='') {
			$lista=$consulta->orderBy('p.nombre','asc')->take(100)->paginate($paginado);
		}
		else{
			$lista=$lista=$consulta->whereRaw("usuarios.usuario like ? or concat(p.nombre ,' ', p.apellido) like ? or pf.nombre like ?",array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
		}

		return $lista;
	}
	
	public function ConsultarPorCodigo($id){

		$usuario=Usuarios::find($id);

		return $usuario;

	}

}
