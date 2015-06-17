<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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
	 select(DB::raw("p.id, concat(p.nombre,' ',p.apellido) as concejal"))->get();

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
		try {

			$lider=Lideres::where('id_persona','=',Auth::user()->id_persona)->first();

			if ($lider) {
			
			Votantes::create(array(
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
			
			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Votante guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el votante.');
			}else{
				return array('show'=>true,'alert'=>'warning','msg'=>'Usted no esta autorizado para registrar votantes, consulte con su administrador.');
			}

		} catch (Exception $e) {
			Excepciones::Crear($e,'VotanteController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

}
