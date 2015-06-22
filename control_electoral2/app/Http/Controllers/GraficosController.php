<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
class GraficosController extends Controller {

	
	public function index()
	{
		$consulta=DB::table('lideres as l')
		->join('personas as p','l.id_persona','=','p.id')
		->join('votantes as v','v.id_lider','=','l.id')
		->select(DB::raw("concat(nombre,' ',p.apellido) as nombre, 
			count(v.id) / (select count(v2.id) from votantes as v2) * 100 as votos"))
		->groupBy('l.id')
		->get();

		$lista=array();
		foreach ($consulta as $key => $item) {
			$lista[]=array($item->nombre,$item->votos);
		}

		return view('graficos/graficos',array('lista'=>$consulta));
	}

	

}
