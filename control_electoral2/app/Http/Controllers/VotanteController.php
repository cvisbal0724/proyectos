<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Enums\EnumPerfiles;
use App\models\Votantes;
use App\models\Excepciones;
use App\models\Lideres;
use App\models\Concejales;
use App\models\TipoVoto;
use App\models\LugaresDeVotacion;
use App\models\CategoriaVotacion;
use DB;
use Auth;

class VotanteController extends Controller {


	public function index(){
	

	 $concejales=Db::table('lider_concejales as lc')->
	 join('concejales as c','lc.id_concejal','=','c.id')->
	 join('personas as p','c.id_persona','=','p.id')->
	 select(DB::raw("c.id, concat(p.nombre,' ',p.apellido) as concejal"))->get();

	 $tipoVoto=TipoVoto::all();
	 $lugarVotacion=LugaresDeVotacion::all();	 
	 if ($concejales) {
	 	$categoriaVotacion=CategoriaVotacion::all();
	 }else{
	 	$categoriaVotacion=CategoriaVotacion::where('id','=',2)->get();
	 }
	 $variables=array('concejales'=>$concejales,'tipovoto'=>$tipoVoto,'lugarVotacion'=>$lugarVotacion,'categoriaVotacion'=>$categoriaVotacion);

	 return view('votantes/votante',$variables);

	}

	public function Crear(Request $request){

		DB::beginTransaction();
		try {

			$lider=Lideres::where('id_persona','=',Auth::user()->id_persona)->first();

			if ($lider) {
			
			$rs=Votantes::create(array(
				'id_persona'=>$request->input('id_persona'),
				'id_lider'=>$lider->id,
				'id_concejal'=>$request->input('id_concejal')>0 ? $request->input('id_concejal') : DB::raw('NULL'),
				'voto'=>0,
				'id_tipo_voto'=>$request->input('id_tipo_voto'),
				'id_categoria_votacion'=>$request->input('id_categoria_votacion'),
				'comentario'=>$request->input('comentario'),
				'id_lugar_de_votacion'=>$request->input('id_lugar_de_votacion') > 0 ? $request->input('id_lugar_de_votacion') : DB::raw('NULL'),
				'numero_mesa'=>$request->input('numero_mesa') > 0 ? $request->input('numero_mesa') : DB::raw('NULL'),
				'dar_de_baja'=>0
			));	
			
			DB::commit();
			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Votante guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el votante.');
			}else{
				return array('show'=>true,'alert'=>'warning','msg'=>'Usted no esta autorizado para registrar votantes, consulte con su administrador.');
			}

		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'VotanteController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}


	public function Consultar(Request $request){
		
		$usuario=Auth::User();
		
		$criterio=$request->input('criterio');
		$lista=array();
		$consulta=DB::table('votantes as v')
			->join('personas as p','v.id_persona','=','p.id')			
			->join('lideres as l','v.id_lider','=','l.id')
			->join('personas as p2','v.id_persona','=','p2.id')			
			->join('categoria_votacion as cv','v.id_categoria_votacion','=','cv.id')
			->join('tipo_voto as tv','v.id_tipo_voto','=','tv.id')	
			->leftJoin('concejales as c','v.id_concejal','=','c.id')
			->leftJoin('personas as p3','c.id_persona','=','p3.id')		
			->select(DB::raw("v.id,concat(p.nombre , ' ', p.apellido) as votante,concat(p2.nombre , ' ' , p2.apellido) as lider,
				ifnull(concat(p3.nombre , ' ' , p3.apellido),'N/A') as concejal,cv.nombre as votar_por,tv.nombre as tipo_voto"));
		
		$paginado=10;

			if ($usuario->id_perfil==EnumPerfiles::Administrador) {
				$consulta=$consulta->where('p.id_alcalde','=',$usuario->persona->id_alcalde);				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {	
					
				$consulta=$consulta->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->whereIn('v.id_categoria_votacion',array(2,3));
				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Concejal) {
				$concejal=Concejales::where('id_persona','=',$usuario->id_persona)->first();
				$consulta=$consulta->where('v.id_concejal','=',$concejal->id);				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Lider) {
				$lider=Lideres::where('id_persona','=',$usuario->id_persona)->first();
				$consulta=$consulta->where('v.id_lider','=',$lider->id);
			}

		if ($criterio=='') {
			$lista=$consulta->orderBy('p.nombre','asc')->take(100)->paginate($paginado);	
		}
		else{
			
			$lista=$consulta->whereRaw(" (concat(p.nombre ,' ', p.apellido) like ? or concat(p2.nombre ,' ', p2.apellido) like ? or concat(p3.nombre ,' ', p3.apellido) like ? )",
				array('%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
		}

		return $lista;
	}

}


