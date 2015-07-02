<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Enums\EnumPerfiles;
use DB;
class DashBoardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usuario=Auth::User();
		$lideres=null;
		$concejales=null;

		$consConcejales=DB::table('concejales as c')
			->join('personas as p','c.id_persona','=','p.id')
			->join('partidos as pt','c.id_partido','=','pt.id')
			->join('alcaldes as al','p.id_alcalde','=','al.id')
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)
			->select(DB::raw("c.id, c.numero, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
				(select count(id) from votantes v where v.id_concejal=c.id) as votos,c.foto"));
		
		$consLideres=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')			
			->select(DB::raw("l.id,concat(p.nombre,' ',p.apellido) as lider,
			(select count(v.id) from votantes v where v.id_lider=l.id) as votos,l.foto"))	
			->groupBy('p.cedula');
				
		if ($usuario->id_perfil==EnumPerfiles::Administrador) {
			
			$concejales=$consConcejales
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();

			$lideres=$consLideres		
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();
			
		}		
		else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {
			
			$concejales=$consConcejales
			->where('p.id_alcalde','=',$usuario->persona->id_alcalde)->get();

			$lideres=$consLideres		
			->where('l.id_encargado','=',$usuario->id)->get();
			
		}else if($usuario->id_perfil==EnumPerfiles::Concejal){
			
			$lideres=$consLideres		
			->where('l.id_encargado','=',$usuario->id)->get();

		}else if($usuario->id_perfil==EnumPerfiles::Lider){
			
			$lideres=$consLideres		
			->where('l.id_persona','=',$usuario->persona->id)->get();
			
		}		
		
		return view('inicio/dashboard',array('concejales'=>$concejales,'lideres'=>$lideres));
	}

	
}
