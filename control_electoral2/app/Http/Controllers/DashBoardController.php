<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Enums\EnumPerfiles;
use DB;
use App\models\Usuarios;
use Cookie;

class DashBoardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if (Cookie::get('id_usuario')>0) {
		return view('inicio/dashboard',$this->Lista());
		}else{
			return view('inicio/acceso_denegado');
		}
		
	}


	public function Notificacion()
	{
		try {
			
			return view('layouts/notificaciones',$this->Lista());

		} catch (Exception $e) {
			
		}
	}

	public function Lista()
	{
		$usuario=Usuarios::find(Cookie::get('id_usuario'));//Auth::User();
		$lideres=array();
		$concejales=null;

		$consConcejales=DB::table('concejales as c')
			->join('personas as p','c.id_persona','=','p.id')
			->join('partidos as pt','c.id_partido','=','pt.id')
			->join('alcaldes as al','p.id_alcalde','=','al.id')
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde);
			/*->select(DB::raw("c.id, c.numero, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
				(select count(id) from votantes v where v.id_concejal=c.id) as votos,c.foto"));*/
		
		$consLideres=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')			
			/*->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id) as votos,l.foto"))*/	
			->groupBy('p.cedula');
				
		if ($usuario->id_perfil==EnumPerfiles::Administrador) {
			
			$concejales=$consConcejales
			->select(DB::raw("c.id, c.numero, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
				(select count(v.id) from votantes v where v.id_concejal=c.id and v.voto=0) as votos,
				(select count(v.id) from votantes v where v.id_concejal=c.id and v.voto=1) as registrados,c.foto"))
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();

			/*$lideres=$consLideres
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id and v.voto=0) as votos,
			(select count(id) from votantes v where v.id_lider=l.id and v.voto=1) as registrados,l.foto"))		
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();*/
			
		}		
		else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {
			
			$concejales=$consConcejales
			->select(DB::raw("c.id, c.numero, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
				(select count(id) from votantes v where v.id_concejal=c.id and v.id_categoria_votacion in (2,3) and v.voto=0) as votos,
				(select count(id) from votantes v where v.id_concejal=c.id and v.id_categoria_votacion in (2,3) and v.voto=1) as registrados,c.foto,c.id_persona"))
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();

			$listaConcejal=array();

			foreach ($concejales as $key => $item) {
				$listaConcejal[$key]=$item->id_persona;
			}

			$lideres=$consLideres	
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id and v.id_categoria_votacion in (2,3) and v.voto=0) as votos,
			(select count(id) from votantes v where  v.id_lider=l.id and v.id_categoria_votacion in (2,3) and v.voto=1) as registrados,l.foto"))						
			->where('l.id_encargado','=',$usuario->id)
			->whereNotIn('l.id_persona',$listaConcejal)->get();
			
		}else if($usuario->id_perfil==EnumPerfiles::Concejal){
			
			//$lideres=$consLideres
			//->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			//(select count(v.id) from votantes v where v.id_lider=l.id and v.voto=0) as votos,
			//(select count(id) from votantes v where v.id_lider=l.id and v.voto=1) as registrados,l.foto"))		
			//->where('p.id_alcalde','=',$usuario->persona->id)->get();

			$lideres=$consLideres
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id and v.voto=0) as votos,
			(select count(id) from votantes v where v.id_lider=l.id and v.voto=1) as registrados,l.foto"))		
			->where('l.id_encargado','=',$usuario->id)->get();

		}else if($usuario->id_perfil==EnumPerfiles::Lider){
			
			//$lideres=$consLideres
			//->select(DB::raw("l.id, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
			//	(select count(id) from votantes v where v.id_concejal=l.id and v.voto=0) as votos,
			//	(select count(id) from votantes v where v.id_concejal=l.id and v.voto=1) as registrados,c.foto"))	
			//->where('l.id_persona','=',$usuario->persona->id)->get();

			$lideres=$consLideres
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id and v.voto=0) as votos,
			(select count(id) from votantes v where v.id_lider=l.id and v.voto=1) as registrados,l.foto"))		
			->where('p.id_alcalde','=',$usuario->persona->id)->get();
			
		}

		return array('concejales'=>$concejales,'lideres'=>$lideres);	
	}
	
}
