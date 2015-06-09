<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Menus;
use App\models\Modulos;
use App\models\Execepciones;

class MenuController extends Controller {

	public function Crear(Request $request){
		try {
			
			$rs=Menus::create(array(
				'nombre'=>'',
				'etiqueta'=>$request->input('etiqueta'),
				'id_padre'=>$request->input('id_padre'),
				'id_modulo'=>$request->input('id_modulo'),
				'url'=>$request->input('url'),
				'orden'=>$request->input('orden'),
				'imagen'=>$request->input('imagen')
			));

			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Menu agregado satisfactoriamente.','data'=>Menus::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el menu.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'MenuController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function ConsultarMenuPorModulo($id_modulo){

		$lista= Menus::where('id_modulo','=',$id_modulo)->get();
		$modulo=Modulos::find($id_modulo);
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

		$menus[]=array(
					'id'=>0,
					'nombre'=>$modulo->nombre,
					'etiqueta'=>'Modulo-'.$modulo->nombre,
					'id_padre'=>0,
					'id_modulo'=>$id_modulo,
					'url'=>'',
					'orden'=>0,
					'imagen'=>'fa fa-home',
					'hijos'=>$menu);

		return $menus;

	}

}
