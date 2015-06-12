<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Concejales;
use Auth;

class ConcejalController extends Controller {

public function Crear(Request $request){
	try {

			$concejal=Concejales::where('id_persona','=',$request->input('id_persona'))->first();
			
			if ($concejal) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El concejal ya existe.');
			}
			
			$rs=Concejales::create(array(
				'id_persona'=>$request->input('id_persona'),
				'id_usuario'=>Auth::user()->id,
				'id_partido'=>$request->input('id_partido'),
				'numero'=>$request->input('numero')
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'ConcejalController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Actualizar(Request $request){
	try {

			$concejal=Concejales::find($request->input('id'));
						
			$concejal->id_persona=$request->input('id_persona');
			$concejal->id_usuario=$request->input('id_usuario');
			$concejal->id_partido=$request->input('id_partido');
			$concejal->numero=$request->input('numero');
			$rs=$concejal->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Persona guardada satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar la persona.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'ConcejalController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}

public function Consultar(Request $request){
		
		$criterio=$request->input('criterio');
		$lista=array();
		$paginado=10;
		if ($criterio=='') {
			$lista=Concejales::take(100)->orderBy('id','desc')->paginate($paginado);
		}
		else{
			//$lista=Usuarios::whereRaw("cedula like ? or concat(nombre ,' ', apellido) like ? or telefono like ?",array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			//->orderBy('nombre','asc')->paginate($paginado);
		}

		return $lista;
	}

public function ConsultarPorCodigo($id){

	$concejal=Concejales::find($id);
	
	return array(
		'id'=>$concejal->id,
		'id_persona'=>$concejal->id_persona,
		'id_usuario'=>$concejal->id_usuario,
		'id_partido'=>$concejal->id_partido,
		'numero'=>$concejal->numero,
		'persona'=>$concejal->persona,
		'_token'=>csrf_token()
	);
}

}