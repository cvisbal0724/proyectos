<?php namespace App\Http\Controllers;

use App\models\Menus;
use App\models\PerfilModulos;
use Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usuario=Auth::User();
		$perfilMod= PerfilModulos::where('id_perfil','=',$usuario->id_perfil)->get();
		$modulos=array();
		foreach ($perfilMod as $key => $item) {
			$modulos[$key]=$item->id_modulo;
		}

		$lista=Menus::whereIn('id_modulo',$modulos)->get();

		$menu=array();

	$i=-1;	
	foreach ($lista as $key => $row) {
		if ($row->id_padre==0) {
			$menu[]=array(
				'id'=>$row->id,
				'nombre'=>$row->nombre,
				'etiqueta'=>$row->etiqueta,
				'id_padre'=>$row->id_padre,
				'id_modulo'=>$row->id_modulo,
				'url'=>$row->url,
				'orden'=>$row->orden,
				'imagen'=>$row->imagen,
				'hijos'=>array());

			$i++;

		}
		
		foreach ($lista as $key2 => $row2) {

			if ($row->id==$row2->id_padre) {

				$hijo=array(
					'id'=>$row2->id,
					'nombre'=>$row2->nombre,
					'etiqueta'=>$row2->etiqueta,
					'id_padre'=>$row2->id_padre,
					'id_modulo'=>$row2->id_modulo,
					'url'=>$row2->url,
					'orden'=>$row2->orden,
					'imagen'=>$row2->imagen);

				$menu[$i]['hijos'][]=$hijo;
				
			}
		}
	}

	return view('inicio/home',array('menu'=>$menu));

	}

}
