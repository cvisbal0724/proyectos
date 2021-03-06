<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\Lideres;
use App\models\LiderConcejales;
use App\models\Concejales;
use DB;

class LiderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('lideres/lider',array('usuario'=>Auth::user()));
	}

	public function Crear(Request $request){
		DB::beginTransaction();
	try {

			$lider=Lideres::where('id_persona','=',$request->input('id_persona'))->first();
			
			if ($lider) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El lider ya existe.');
			}
						
		   $rs=Lideres::create(array(		   	   
			   'id_persona'=>$request->input('id_persona'),
			   'id_encargado'=>Auth::user()->id				
		   ));
			
			$concejal=Concejales::where('id_persona','=',Auth::user()->persona->id)->first();
			if ($concejal) {
				 LiderConcejales::create(array(
			   	'meta'=>$request->input('meta'),
			   	'id_lider'=>$rs['id'],
			   	'id_concejal'=>$concejal->id
			   	));
			}else{			

				//DB::rollback();
				//return array('show'=>true,'alert'=>'warning','msg'=>'Usted no tiene permitido crear lider, consulte su administrador.');
			}
		  
	   		DB::commit();

		  return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Lider guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el lider.');
			
		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'LiderController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Actualizar(Request $request){
	try {

			$lider=Lideres::find($request->input('id'));
						
			$lider->id_persona=$request->input('id_persona');
			$rs=$lider->save();

			$concejal=Concejales::where('id_persona','=',$request->input('id_persona'))->first();
			
			$liderConcejal=LiderConcejales::where('id_concejal','=',$concejal->id)->where('id_lider','=',$lider->id)->first();
			$liderConcejal->meta=$request->input('meta');
			$liderConcejal->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Lider actualizado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el lider.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'LiderController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Consultar(Request $request){
		
		$criterio=$request->input('criterio');
		$lista=array();
		
		$consulta=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')			
			->join('usuarios as u','l.id_encargado','=','u.id')
			->join('personas as p2','u.id_persona','=','p2.id')
			->join('alcaldes as al','p.id_alcalde','=','al.id')
			->leftJoin('lider_concejales as lc','lc.id_lider','=','l.id')
			->leftJoin('concejales as c','lc.id_concejal','=','c.id')
			->leftJoin('personas as p3','c.id_persona','=','p3.id')
			->select(DB::raw("l.id,ifnull(lc.meta,'N/A') as meta,concat(p.nombre,' ',p.apellido) as lider,
			concat(p2.nombre,' ',p2.apellido) as encargado,ifnull(concat(p3.nombre,' ', p3.apellido),'N/A') as concejal,
			al.nombre as alcalde"))
			->groupBy(DB::raw('lc.meta,p.cedula,p2.cedula,p3.cedula'));
		$paginado=10;
		if ($criterio=='') {
			$lista=$consulta->where('l.id_encargado','=',Auth::user()->id)->orderBy('p.nombre','asc')->take(100)->paginate($paginado);
		}
		else{
			$lista=$lista=$consulta->whereRaw("l.id_encargado=? and concat(p.nombre ,' ', p.apellido) like ?",array(Auth::user()->id,'%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
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

public function AgregarLiderConcejales(Request $request){
	try {

		$lista=$request->input('listaConcejales');
		
		foreach ($lista as $key => $item) {
			$liderConc=LiderConcejales::where('id_lider','=',$item['id_lider'])->where('id_concejal','=',$item['id_concejal'])->get();			
			if (count($liderConc)==0) {
				LiderConcejales::create($item);
			}			
		}
		return LiderConcejales::where('id_lider','=',$lista[0]['id_lider'])->get();	
	} catch (Exception $e) {
		
	}	
}

public function ConsultarLiderConcejales(Request $request){

	return LiderConcejales::where('id_lider','=',$request->input('id_lider'))->get();
}

}

