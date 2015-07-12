<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Personas;
use File;
use Auth;
use Input;

class PersonaController extends Controller {

	public function Crear(){
		try {

			$persona=Personas::where('cedula','=',Input::get('cedula'))->where('id_alcalde','=',Input::get('id_alcalde'))->get();

			if (count($persona)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Ya existe una persona con esta cedula.');	
			}

			$rs=Personas::create(array(
				'cedula'=>Input::get('cedula'),
				'nombre'=>Input::get('nombre'),
				'apellido'=>Input::get('apellido'),
				'telefono'=>Input::get('telefono'),
				'direccion'=>Input::get('direccion'),
				'correo'=>Input::get('correo'),
				'id_alcalde'=>Input::get('id_alcalde')
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function Actualizar(){
		try {

				$persona=Personas::find(Input::get('id'));
			
				$persona->cedula=Input::get('cedula');
				$persona->nombre=Input::get('nombre');
				$persona->apellido=Input::get('apellido');
				$persona->telefono=Input::get('telefono');
				$persona->direccion=Input::get('direccion');
				$persona->correo=Input::get('correo');
				$persona->id_alcalde=Input::get('id_alcalde');
				$rs=$persona->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(){
		
		$criterio=Input::get('criterio');
		$lista=array();
		$paginado=10;
		if ($criterio=='') {
			$lista=Personas::take(100)->orderBy('nombre','asc')->paginate($paginado);
		}
		else{
			$lista=Personas::whereRaw("cedula like ? or concat(nombre ,' ', apellido) like ? or telefono like ?",array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('nombre','asc')->paginate($paginado);
		}

		return $lista;
	}
	
	public function ConsultarPorCodigo($id){

		$persona=Personas::find($id);

		return $persona;

	}

	public function ConsultarPorCriterios(){

		$criterio=Input::get('criterio');
		if ($criterio!='') {
			return Personas::whereRaw("cedula like ? or concat(nombre ,' ', apellido) like ? ",array('%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('nombre','asc')->get();
		}		
		return array();
	}

	public function CrearNuevaPersona(){
		try {

			$usuario=Auth::User();
			$persona=Personas::where('cedula','=',Input::get('cedula'))->where('id_alcalde','=',$usuario->persona->id_alcalde)->get();

			if (count($persona)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Ya existe una persona con esta cedula.');	
			}

			$rs=Personas::create(array(
				'cedula'=>Input::get('cedula'),
				'nombre'=>Input::get('nombre'),
				'apellido'=>Input::get('apellido'),
				'telefono'=>Input::get('telefono'),
				'direccion'=>Input::get('direccion'),
				'correo'=>Input::get('correo'),
				'id_alcalde'=>$usuario->persona->id_alcalde
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','CrearNuevaPersona');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function ActualizarNuevaPersona(){
		try {

				$persona=Personas::find(Input::get('id'));
			
				$persona->cedula=Input::get('cedula');
				$persona->nombre=Input::get('nombre');
				$persona->apellido=Input::get('apellido');
				$persona->telefono=Input::get('telefono');
				$persona->direccion=Input::get('direccion');
				$persona->correo=Input::get('correo');				
				$rs=$persona->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

}
