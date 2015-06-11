<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Personas;
use File;

class PersonaController extends Controller {

	public function Crear(Request $request){
		try {

			$persona=Personas::where('cedula','=',$request->input('cedula'))->where('id_alcalde','=',$request->input('id_alcalde'))->get();

			if (count($persona)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'Ya existe una persona con esta cedula.');	
			}

			$rs=Personas::create(array(
				'cedula'=>$request->input('cedula'),
				'nombre'=>$request->input('nombre'),
				'apellido'=>$request->input('apellido'),
				'telefono'=>$request->input('telefono'),
				'direccion'=>$request->input('direccion'),
				'correo'=>$request->input('correo'),
				'id_alcalde'=>$request->input('id_alcalde')
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function Actualizar(Request $request){
		try {

				$persona=Personas::find($request->input('id'));
			
				$persona->cedula=$request->input('cedula');
				$persona->nombre=$request->input('nombre');
				$persona->apellido=$request->input('apellido');
				$persona->telefono=$request->input('telefono');
				$persona->direccion=$request->input('direccion');
				$persona->correo=$request->input('correo');
				$persona->id_alcalde=$request->input('id_alcalde');
				$rs=$persona->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'PersonaController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(Request $request){
		
		$criterio=$request->input('criterio');
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

		return array(
			'id'=>$persona->id,
			'cedula'=>$persona->cedula,
			'nombre'=>$persona->nombre,
			'apellido'=>$persona->apellido,
			'telefono'=>$persona->telefono,
			'direccion'=>$persona->direccion,
			'correo'=>$persona->correo,
			'id_alcalde'=>$persona->id_alcalde,
			'_token'=>csrf_token()
		);

	}

	public function ConsultarPorCriterios(Request $request){

		$criterio=$request->input('criterio');
		if ($criterio!='') {
			return Personas::whereRaw("cedula like ? or concat(nombre ,' ', apellido) like ? ",array('%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('nombre','asc')->get();
		}		
		return array();
	}

}
