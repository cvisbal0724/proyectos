<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Menus;
use App\models\Execepciones;

class MenuController extends Controller {

	public function Guardar(){
		try {
			
		} catch (Exception $e) {
			
		}
	}

	public function ConsultarMenuPorModulo($id_modulo){

		$lista= Menus::where('id_modulo','=',$id_modulo)->get();

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

		return $menu;

	}

}
