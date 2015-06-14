<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Concejales;
use App\models\Lideres;
use Auth;
use DB;

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

			$lider=Lideres::where('id_persona','=',$request->input('id_persona'))->get();
			if (count($lider)==0) {
				Lideres::create(array(
				'id_persona'=>$request->input('id_persona'),
				'id_encargado'=>Auth::user()->id				
				));
			}
			
			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Concejal guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el concejal.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'ConcejalController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Actualizar(Request $request){
	try {

			$concejal=Concejales::find($request->input('id'));
						
			$concejal->id_persona=$request->input('id_persona');			
			$concejal->id_partido=$request->input('id_partido');
			$concejal->numero=$request->input('numero');
			$rs=$concejal->save();

			$lider=Lideres::where('id_persona','=',$request->input('id_persona'))->get();
			if (count($lider)==0) {
				Lideres::create(array(
				'id_persona'=>$request->input('id_persona'),
				'id_encargado'=>$request->input('id_usuario')				
				));
			}

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Concejal guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el concejal.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'ConcejalController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}

public function Consultar(Request $request){
		
		$criterio=$request->input('criterio');
		$lista=array();
		$consulta=DB::table('concejales')
			->join('personas','concejales.id_persona','=','personas.id')
			->join('partidos','concejales.id_partido','=','partidos.id')
			->join('alcaldes','personas.id_alcalde','=','alcaldes.id')
			->select('concejales.id','concejales.numero','personas.nombre','personas.apellido','partidos.nombre as partido','alcaldes.nombre as alcalde');
		$paginado=10;
		if ($criterio=='') {
			$lista=$consulta->orderBy('personas.nombre','asc')->paginate(100);
		}
		else{
			$lista=$lista=$consulta->whereRaw("Usuarios.numero like ? or concat(personas.nombre ,' ', personas.apellido) like ? or partidos.nombre like ?",array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('personas.nombre','asc')->paginate($paginado);
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
