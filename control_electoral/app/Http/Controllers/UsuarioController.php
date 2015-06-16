<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Execepciones;
use App\models\Personas;
use App\models\Usuarios;
use Hash;
use DB;

class UsuarioController extends Controller {

	public function Crear(Request $request){
		try {
			
			$usuario=Usuarios::where('usuario','=',$request->input('usuario'))->first();
			if ($usuario) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El usuario ya existe.');
			}
			$rs=Usuarios::create(array(
				'usuario'=>$request->input('usuario'),
				'password'=>Hash::make('12345'),
				'id_persona'=>$request->input('id_persona'),
				'id_perfil'=>$request->input('id_perfil'),
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Usuario guardado satisfactoriamente.','data'=>'') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el usuario.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'UsuarioController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Actualizar(Request $request){
			try {
					
				$usuario=Usuarios::find($request->input('id'));
					
				$usuario->id_persona=$request->input('id_persona');
				$usuario->id_perfil=$request->input('id_perfil');
				$rs=$usuario->save();

				return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Usuario actualizado satisfactoriamente.','data'=>'') :
						array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el usuario.');

			} catch (Exception $e) {
				Excepciones::Crear($e,'UsuarioController','Actualizar');
				return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
			}
		}	

	public function Consultar(Request $request){
		
		$criterio=$request->input('criterio');
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
			$lista=$lista=$consulta->whereRaw("Usuarios.usuario like ? or concat(p.nombre ,' ', p.apellido) like ? or pf.nombre like ?",array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
		}

		return $lista;
	}
	
	public function ConsultarPorCodigo($id){

		$usuario=Usuarios::find($id);

		return array(
			'id'=>$usuario->id,
			'usuario'=>$usuario->usuario,
			'password'=>$usuario->password,
			'id_persona'=>$usuario->id_persona,
			'id_perfil'=>$usuario->id_perfil,
			'persona'=>$usuario->persona,
			'_token'=>csrf_token()
		);

	}

}
