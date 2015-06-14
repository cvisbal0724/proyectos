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

				DB::rollback();
				return array('show'=>true,'alert'=>'warning','msg'=>'Usted no tiene permitido crear lider, consulte su administrador.');
			}
		  
	   

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
		/*$consulta=DB::table('lideres')
			->join('personas','concejales.id_persona','=','personas.id')
			->join('partidos','concejales.id_partido','=','partidos.id')
			->join('alcaldes','personas.id_alcalde','=','alcaldes.id')
			->select('concejales.id','concejales.numero','personas.nombre','personas.apellido','partidos.nombre as partido','alcaldes.nombre as alcalde');*/

		$consulta=DB::table('lideres')
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

/*
select ifnull(lc.meta,0) as meta,concat(p.nombre,' ',p.apellido) as lider,
concat(p2.nombre,' ',p2.apellido) as encargado,ifnull(concat(p3.nombre,' ', p3.apellido),'Ninguno') as concejal,
al.nombre as alcalde
from lideres l 
inner join personas p on l.id_persona=p.id
inner join usuarios u on l.id_encargado=u.id
inner join personas p2 on u.id_persona=p2.id
inner join alcaldes al on p.id_alcalde=al.id
left join lider_concejales lc on lc.id_lider=l.id
left join concejales c on lc.id_concejal=c.id
left join personas p3 on c.id_persona=p3.id
group by meta,p.nombre,p.apellido,p2.nombre,p2.apellido,
p3.nombre,p3.apellido
*/