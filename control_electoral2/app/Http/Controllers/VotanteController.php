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
use App\models\AuditoriaVotante;
use DB;
use Auth;
use Input;
use App\models\Usuarios;
use App\models\Zonas;
use Cookie;
use Session;

class VotanteController extends Controller {


	public function index(){
	
	 $usuario=Usuarios::find(Cookie::get('id_usuario'));
	 $lider=Lideres::where('id_persona','=',$usuario->id_persona)->first();
	 $variables=array();
	 if ($lider) {
	 		$concejales=Db::table('lider_concejales as lc')->
			 join('concejales as c','lc.id_concejal','=','c.id')->
			 join('personas as p','c.id_persona','=','p.id')->
			 where('lc.id_lider','=',$lider->id)->
			 select(DB::raw("c.id, concat(p.nombre,' ',p.apellido) as concejal"))->get();

			 $tipoVoto=TipoVoto::all();
			 //$lugarVotacion=LugaresDeVotacion::all();	
			 $zonas=Zonas::all(); 
			 if (count($concejales)>0) {
			 	$categoriaVotacion=CategoriaVotacion::all();
			 }else{
			 	$categoriaVotacion=CategoriaVotacion::where('id','=',2)->get();
			 }

			 //'lugarVotacion'=>$lugarVotacion,
			 $variables=array('concejales'=>$concejales,'tipovoto'=>$tipoVoto,'zonas'=>$zonas,'categoriaVotacion'=>$categoriaVotacion);

			 return view('votantes/votante',$variables);

	}	
	 return '<h3>Usted no tiene acceso a esta pagina porque no esta registrado como lider.</h3>';
	}

	public function Crear(){

		DB::beginTransaction();
		try {

			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$lider=Lideres::where('id_persona','=',$usuario->id_persona)->first();

			if ($lider) {
			
			$votante=Votantes::where('id_persona','=',Input::get('id_persona'))
			->where('dar_de_baja','=',0)
			//->whereIn('id_categoria_votacion',array(2,3))
			->first();

			if ($votante) {

				$nombreLider=$votante->lider->persona->nombre . ' ' .$votante->lider->persona->apellido;
				if ($votante->id_categoria_votacion==2 && Input::get('id_categoria_votacion')==2)/*Concejo*/ {
										
					return array('show'=>true,'alert'=>'warning','msg'=>'No puede guardar el votante porque ya esta a cargo de  ' . $nombreLider . '.');
				}
				elseif ($votante->id_categoria_votacion==3/*Alcaldia y concejo*/) {
										
					return array('show'=>true,'alert'=>'warning','msg'=>'No puede guardar el votante porque ya esta a cargo de  ' . $nombreLider . '.');

				}elseif ($votante->id_categoria_votacion==1 && Input::get('id_categoria_votacion')==1/*Alcaldia*/) {

					return array('show'=>true,'alert'=>'warning','msg'=>'No puede guardar el votante porque ya esta a cargo de ' . $nombreLider . '.');
				}
				
			}
			$rs=Votantes::create(array(
				'id_persona'=>Input::get('id_persona'),
				'id_lider'=>$lider->id,
				'id_concejal'=>Input::get('id_concejal')>0 ? Input::get('id_concejal') : DB::raw('NULL'),
				'voto'=>0,
				'id_tipo_voto'=>Input::get('id_tipo_voto'),
				'id_categoria_votacion'=>Input::get('id_categoria_votacion'),
				'comentario'=>Input::get('comentario'),
				'id_lugar_de_votacion'=>Input::get('id_lugar_de_votacion') > 0 ? Input::get('id_lugar_de_votacion') : DB::raw('NULL'),
				'numero_mesa'=>Input::get('numero_mesa') > 0 ? Input::get('numero_mesa') : DB::raw('NULL'),
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

	public function Actualizar()
	{
		try {
			
			$votante=Votantes::find(Input::get('id'));

			$votante->id_persona=Input::get('id_persona');
			$votante->id_lider=Input::get('id_lider');
			$votante->id_concejal=Input::get('id_concejal');
			$votante->id_tipo_voto=Input::get('id_tipo_voto');
			$votante->id_categoria_votacion=Input::get('id_categoria_votacion');
			$votante->comentario=Input::get('comentario');
			$votante->id_lugar_de_votacion=Input::get('id_lugar_de_votacion');
			$votante->numero_mesa=Input::get('numero_mesa');
			$rs=$votante->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Votante actualizado satisfactoriamente.','data'=>'') :
						array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el votante.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'VotanteController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(){
		
		//$usuario=Auth::User();
		$usuario=Usuarios::find(Cookie::get('id_usuario'));
//print_r($usuario);
		$criterio=Input::get('criterio');
		$lista=array();
		$consulta=DB::table('votantes as v')
			->join('personas as p','v.id_persona','=','p.id')			
			->join('lideres as l','v.id_lider','=','l.id')
			->join('personas as p2','l.id_persona','=','p2.id')			
			->join('categoria_votacion as cv','v.id_categoria_votacion','=','cv.id')
			->join('tipo_voto as tv','v.id_tipo_voto','=','tv.id')	
			->leftJoin('concejales as c','v.id_concejal','=','c.id')
			->leftJoin('personas as p3','c.id_persona','=','p3.id')		
			->select(DB::raw("v.id,concat(p.nombre , ' ', p.apellido) as votante,concat(p2.nombre , ' ' , p2.apellido) as lider,
				ifnull(concat(p3.nombre , ' ' , p3.apellido),'N/A') as concejal,cv.nombre as votar_por,tv.nombre as tipo_voto,v.voto"))
			->where('v.dar_de_baja','=',0);
		
		$paginado=10;
	
			if ($usuario->id_perfil==EnumPerfiles::Administrador) {
				$consulta=$consulta->where('p.id_alcalde','=',$usuario->persona->id_alcalde);						
			}
			else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {	
					
				$consulta=$consulta->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->whereIn('v.id_categoria_votacion',array(1,3));
				
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

	public function ConsultarPorCodigo($id){
		
		$votante=Votantes::find($id);

		return $votante;
	}

	public function DarDeBaja()
	{
		DB::beginTransaction();
		try {
			
			//$usuario=Auth::User();
			$usuario=Usuarios::find(Cookie::get('id_usuario'));

			$votante=Votantes::find(Input::get('id'));

			$votante->dar_de_baja=1;
			$votante->save();

			 $rs=AuditoriaVotante::create(array(
				'id_votante'=>$votante->id,
				'id_usuario'=>$usuario->id,
				'observacion'=>Input::get('observacion')
				)
			);

			 DB::commit();

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Se le ha dado de baja al votante satisfactoriamente.','data'=>'') :
						array('show'=>true,'alert'=>'warning','msg'=>'No se pudo dar de baja al votante.');

		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'VotanteController','DarDeBaja');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function ConsultarCategoriaVotacion($id_persona){
		try {
			
			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$votante=Votantes::where('id_persona','=',$id_persona)
			->where('dar_de_baja','=',0)->get();
			
			$lider=Lideres::where('id_persona','=',$usuario->id_persona)->first();
			$variables=array();

		 	$concejales=Db::table('lider_concejales as lc')->
			 join('concejales as c','lc.id_concejal','=','c.id')->
			 join('personas as p','c.id_persona','=','p.id')->
			 where('lc.id_lider','=',$lider->id)->
			 select(DB::raw("c.id, concat(p.nombre,' ',p.apellido) as concejal"))->get();

			
			$categoriaVotacion=array();

			if (count($votante)==0) {
				$categoriaVotacion=CategoriaVotacion::all();
			}else {

				$categorias=array();
				///quede por aqui tengo que verificar si la persona tiene concejales
				///si tiene entonces mostrar la categoria concejales tambien dependiendo si la 
				///persona no tiene compromisos con otro lider	
				foreach ($votante as $key => $item) {
					if ($item->id_categoria_votacion==3) {
						return array();
					}
					if (count($concejales)==0) {
						$categorias[$key]=$item->id_categoria_votacion;
					}else if (count($concejales)>0) {
						# code...
					}
					
				}
				$categoriaVotacion=CategoriaVotacion::whereNotIn('id', $categorias);
			}

			return $categoriaVotacion;

		} catch (Exception $e) {
			return $e->getMessage();			
		}
	}


	public function Reporte()
	{
		try {
						
			return view('votantes/reporte_votantes');

		} catch (Exception $e) {
			return $e;
		}		
	}

	public function RegistrarVoto()
	{
		DB::beginTransaction();
		try {
			
			//$usuario=Auth::User();
			$usuario=Usuarios::find(Cookie::get('id_usuario'));

			$votante=Votantes::find(Input::get('id'));

			$votante->voto=1;
			$votante->save();

			 $rs=AuditoriaVotante::create(array(
				'id_votante'=>$votante->id,
				'id_usuario'=>$usuario->id,
				'observacion'=>'Registro voto'
				)
			);

			 DB::commit();

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Se le ha registrado el voto satisfactoriamente.','data'=>'') :
						array('show'=>true,'alert'=>'warning','msg'=>'No se pudo registrar el voto.');

		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'VotanteController','RegistrarVoto');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function ConsultarConcejalYLider(){
		try {
			//$usuario=Auth::User();
			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$concejales=array();
			$lideres=array();

			$consultaConcejal=DB::table('concejales as c')
			->join('personas as p','c.id_persona','=','p.id')
			->select(DB::raw("c.id,c.id_persona,concat(p.nombre,' ',p.apellido) as concejal"));

			$consultaLider=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')
			->select(DB::raw("l.id,l.id_persona,concat(p.nombre,' ',p.apellido) as lider"));

			if ($usuario->id_perfil==EnumPerfiles::Administrador) {
				$concejales=$consultaConcejal->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();

				foreach ($concejales as $key => $item) {
					$listaID[$key]=$item->id_persona;
				}

				$lideres=$consultaLider->where('p.id_alcalde','=',$usuario->persona->id_alcalde)
				->whereNotIn('id_persona',$listaID)->get();
			}
			else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {	
					
				$concejales=$consultaConcejal->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();
				$listaID=array();
				foreach ($concejales as $key => $item) {
					$listaID[$key]=$item->id_persona;
				}

				$lideres=$consultaLider->where('p.id_alcalde','=',$usuario->persona->id_alcalde)
				->whereNotIn('id_persona',$listaID)->get();
				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Concejal) {
				$lideres=$consultaLider->where('p.id_encargado','=',$usuario->id)->get();
			}
			else if ($usuario->id_perfil==EnumPerfiles::Lider) {
				$lideres=$consultaLider->where('p.id_encargado','=',$usuario->id)->get();
			}
			return array('concejales'=>$concejales,'lideres'=>$lideres);

		} catch (Exception $e) {
			return $e;
		}
	}

	public function ExportarPDF($concejales, $lideres)
	{
		try {
			
			//$usuario=Auth::User();
			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$listaConcejales=array();
			$listaLideres=array();
			$id_concejales=explode(',',$concejales);
			$id_lideres=explode(',',$lideres);

			if ($usuario->id_perfil==EnumPerfiles::Administrador) {
				if (count($id_concejales)>0) {
					$listaConcejales=DB::table('votantes as v')
					->join('personas as p','v.id_persona','=','p.id')
					->join('concejales as c','v.id_lider','=','c.id')
					->join('personas as p2','c.id_persona','=','p2.id')
					->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
					->whereIn('v.id_concejal',$id_concejales)
					->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
					
					->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
				}else if (count($lideres)>0) {
					$listaLideres=DB::table('votantes as v')
					->join('personas as p','v.id_persona','=','p.id')
					->join('lideres as l','v.id_lider','=','l.id')
					->join('personas as p2','l.id_persona','=','p2.id')
					->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
					->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
					->whereIn('v.id_lider',$id_lideres)
					->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
				}
			}
			else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {	
				if ($concejales!='') {
					$listaConcejales=DB::table('votantes as v')
					->join('personas as p','v.id_persona','=','p.id')
					->join('concejales as c','v.id_lider','=','c.id')
					->join('personas as p2','c.id_persona','=','p2.id')
					->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
					->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
					->whereIn('v.id_concejal',$id_concejales)->whereIn('v.id_categoria_votacion',array(1,2))
					->where('p.id_alcalde','=',$usuario->persona->id_alcalde)
					->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
				}else if ($lideres!='') {
					$listaLideres=DB::table('votantes as v')
					->join('personas as p','v.id_persona','=','p.id')
					->join('lideres as l','v.id_lider','=','l.id')
					->join('personas as p2','l.id_persona','=','p2.id')
					->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
					->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
					->whereIn('v.id_lider',$id_lideres)->whereIn('v.id_categoria_votacion',array(1,2))
					->where('p.id_alcalde','=',$usuario->persona->id_alcalde)
					->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
				}
			}
			else if ($usuario->id_perfil==EnumPerfiles::Concejal) {
				$listaLideres=DB::table('votantes as v')
				->join('personas as p','v.id_persona','=','p.id')
				->join('lideres as l','v.id_lider','=','l.id')
				->join('personas as p2','l.id_persona','=','p2.id')
				->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
				->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
				->whereIn('v.id_lider',$id_lideres)
				->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
			}
			else if ($usuario->id_perfil==EnumPerfiles::Lider) {
				$listaLideres=DB::table('votantes as v')
				->join('personas as p','v.id_persona','=','p.id')
				->join('lideres as l','v.id_lider','=','l.id')
				->join('personas as p2','l.id_persona','=','p2.id')
				->leftJoin('lugares_de_votacion as lv','v.id_lugar_de_votacion','=','lv.id')
				->select(DB::raw("concat(p.nombre,' ',p.apellido) as nombre,p.cedula,p.direccion,p.telefono,lv.nombre as punto_votacion,concat(p2.nombre,' ',p2.apellido) as lider"))
				->whereIn('v.id_lider',$id_lideres)
				->orderBy('p2.nombre')->orderBy('p2.apellido')->orderBy('p2.id')->get();
			}
			
			$view =  \View::make('pdf.reporte_votantes', compact('listaLideres', 'listaConcejales'))->render();

			$pdf = \App::make('dompdf.wrapper');
	        $pdf->loadHTML($view);
	        return $pdf->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->stream('votantes');

		} catch (Exception $e) {
			return $e;
		}	
	}

	public function ObtenerLugaresDeVotacion($id_zona){

		$lugares=LugaresDeVotacion::where('id_zona','=',$id_zona)->get();
		return $lugares;

	}

	public function ObtenerVotosPorPartidos()
	{

		$partido=Input::get('id_partido');
		$lista=array();

		if ($partido!=200) {
			$lista=DB::select('select vw.id_partido,vw.nombre as partido,count(vw.id) as total_votos,vw.logo,vw.id_partido,
							(select count(v1.id)
							from vw_votos_partidos as v1
							where v1.id_partido=vw.id_partido and v1.voto=0) as por_votar,

							(select count(v2.id)
							from vw_votos_partidos as v2
							where v2.id_partido=vw.id_partido and v2.voto=1) as votos_registrados
							from vw_votos_partidos as vw
							where vw.id_partido=?
							group by vw.id_partido',array($partido));
		}else{

			$lista=DB::select('select vw.nombre as partido,count(vw.id) as total_votos,vw.logo,vw.id_partido,
							(select count(v1.id)
							from vw_votos_partidos as v1
							where v1.id_partido=vw.id_partido and v1.voto=0) as por_votar,

							(select count(v2.id)
							from vw_votos_partidos as v2
							where v2.id_partido=vw.id_partido and v2.voto=1) as votos_registrados
							from vw_votos_partidos as vw							
							group by vw.id_partido');

		}
		
		Session::put('reporte_partidos',$lista);
		return $lista;
	}


	public function ObtenerVotosPorResponsables()
	{

		try {
			
			$id_opcion=Input::get('id_opcion');
			$id_encargado=Input::get('id_encargado');
			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$lista=array();
			
			if ($id_opcion==1) {
				
				if ($id_encargado==200) {
				
				$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
							'concejales' as tipo
							from votantes as v
							inner join lideres as l on v.id_lider=l.id
							inner join personas as p on l.id_persona=p.id
							inner join concejales c on c.id_persona=l.id_persona
							inner join usuarios u on l.id_encargado=u.id							
							group by l.id");
				}
				else if ($id_encargado > 0) {
				
				$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
							'concejales' as tipo
							from votantes as v
							inner join lideres as l on v.id_lider=l.id
							inner join personas as p on l.id_persona=p.id
							inner join concejales c on c.id_persona=l.id_persona	
							inner join usuarios u on l.id_encargado=u.id		
							where c.id=?					
							group by l.id",array($id_encargado));
				}
			}
			else if ($id_opcion==2) {
				
				if ($usuario->id_perfil==EnumPerfiles::Concejal || $usuario->id_perfil==EnumPerfiles::Lider) {

					if ($id_encargado==200) {
					
					$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
							(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
							'lideres' as tipo
							from votantes as v
							inner join lideres as l on v.id_lider=l.id
							inner join personas as p on l.id_persona=p.id
							where l.id_encargado=? 
							group by l.id",array(Cookie::get('id_usuario')));					

					}elseif ($id_encargado>0) {
						
						$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
								'lideres' as tipo
								from votantes as v
								inner join lideres as l on v.id_lider=l.id
								inner join personas as p on l.id_persona=p.id
								where l.id_encargado=? and l.id=? 
								group by l.id",array(Cookie::get('id_usuario'),$id_encargado));

					}

				}elseif ($usuario->id_perfil==EnumPerfiles::Alcalde) {
				
					if ($id_encargado==200) {
						
						$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
								'lideres' as tipo
								from votantes as v
								inner join lideres as l on v.id_lider=l.id
								inner join personas as p on l.id_persona=p.id
								where l.id_encargado=? and l.id_persona not in (select c.id_persona from concejales as c)
								group by l.id",array(Cookie::get('id_usuario')));					

					}elseif ($id_encargado>0) {
						
						$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
								'lideres' as tipo
								from votantes as v
								inner join lideres as l on v.id_lider=l.id
								inner join personas as p on l.id_persona=p.id
								where l.id_encargado=? and l.id=? and l.id_persona not in (select c.id_persona from concejales as c)
								group by l.id",array(Cookie::get('id_usuario'),$id_encargado));

					}
				}
				
				

			}
			else if (false) {
				$lista=DB::select("select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
								'lideres' as tipo
								from votantes as v
								inner join lideres as l on v.id_lider=l.id
								inner join personas as p on l.id_persona=p.id
								where l.id_encargado=? and l.id_persona not in (select c.id_persona from concejales as c)
								group by l.id
								union
								select concat(p.nombre,' ', p.apellido) as responsable, count(v.id) as total_votos,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=0) as por_votar,
								(select count(v2.id) from votantes as v2 where v2.id_lider=l.id and v.voto=1) as votos_registrados,
								'concejales' as tipo
								from votantes as v
								inner join lideres as l on v.id_lider=l.id
								inner join personas as p on l.id_persona=p.id
								inner join concejales c on c.id_persona=l.id_persona
								group by l.id",array(Cookie::get('id_usuario')));
			}

			Session::put('reporte_responsables',$lista);
			return $lista;


		} catch (Exception $e) {
			
		}
		
	}

	public function ObtenerConcejalesYLideres($id_opcion)
	{
		$usuario=Usuarios::find(Cookie::get('id_usuario'));
		$lista=array();

		if ($id_opcion==1) {
			$lista=DB::table('concejales as c')
			->join('personas as p','c.id_persona','=','p.id')
			->select(DB::raw("c.id,concat(p.nombre,' ',p.apellido) as nombre"))
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();
		}else if ($id_opcion==2) {
			$lista=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as nombre"))
			->where('l.id_encargado','=',$usuario->id)->get();	
		}

		return $lista;
	}

	public function ObtenerVotosPorConcejales(){

		$lista=DB::select("
			select vw.logo,concat(vw.nombre,' ',vw.apellido) as concejal,vw.partido,
			(select count(v1.id) from vw_votos_por_concejales_y_partidos v1 where v1.id_concejal=vw.id_concejal) as total_votos,
			(select count(v2.id) from vw_votos_por_concejales_y_partidos v2 where v2.id_concejal=vw.id_concejal and v2.voto=0) as por_votar,
			(select count(v3.id) from vw_votos_por_concejales_y_partidos v3 where v3.id_concejal=vw.id_concejal and v3.voto=1) as votos_registrados
			from vw_votos_por_concejales_y_partidos vw
			where vw.id_partido=?
			group by vw.id_concejal",array(Input::get('id_partido')));

		return $lista;

	}

	public function ReportePorResponsables()
	{
		$lista=Session::get('reporte_responsables');

        $view =  \View::make('pdf.reporte_por_responsables', compact('lista'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporte-por-responsables.pdf');
	}

	public function ReportePorPartidos()
	{
		$lista=Session::get('reporte_partidos');

        $view =  \View::make('pdf.reporte_por_partidos', compact('lista'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('reporte-por-partidos.pdf');
	}

}


/*alter view vw_votos_partidos
as
select v.id,pr.nombre,c.id_partido,v.voto,pr.logo
from votantes as v
inner join lideres as l on v.id_lider=l.id
inner join usuarios as u on l.id_encargado=u.id
inner join concejales as c on u.id_persona=c.id_persona
inner join partidos as pr on c.id_partido=pr.id*/


/*alter view vw_votos_por_concejales_y_partidos
as
select v.id,pr.nombre as partido,p.nombre,p.apellido,c.id_partido,v.voto,pr.logo,
c.id as id_concejal
from votantes as v
inner join lideres as l on v.id_lider=l.id
inner join usuarios as u on l.id_encargado=u.id
inner join concejales as c on u.id_persona=c.id_persona
inner join partidos as pr on c.id_partido=pr.id
inner join personas as p on c.id_persona=p.id*/