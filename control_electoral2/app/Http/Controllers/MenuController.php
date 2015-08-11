<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Menus;
use App\models\Modulos;
use App\models\Execepciones;
use Auth;
use Input;
use App\models\Usuarios;
use Cookie;

class MenuController extends Controller {

	public function Crear(){
		try {
			
			$rs=Menus::create(array(
				'nombre'=>'',
				'etiqueta'=>Input::get('etiqueta'),
				'id_padre'=>Input::get('id_padre'),
				'id_modulo'=>Input::get('id_modulo'),
				'url'=>Input::get('url'),
				'orden'=>Input::get('orden'),
				'imagen'=>Input::get('imagen')
			));

			if (Input::get('todos')>0) {
			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Menu agregado satisfactoriamente.','data'=>$this->ConsultarMenuPorModulo()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el menu.');
			}else{
				return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Menu agregado satisfactoriamente.','data'=>$this->ConsultarMenuPorModulo(Input::get('id_modulo'))) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el menu.');
			}

			

		} catch (Exception $e) {
			Excepciones::Crear($e,'MenuController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Actualizar(){
		try {
			
				$menu=Menus::find(Input::get('id'));
			
				$menu->nombre= '';
				$menu->etiqueta= Input::get('etiqueta');
				$menu->id_padre= Input::get('id_padre');
				$menu->id_modulo= Input::get('id_modulo');
				$menu->url= Input::get('url');
				$menu->orden= Input::get('orden');
				$menu->imagen= Input::get('imagen');

				$rs=$menu->save();
			
			if (Input::get('todos')>0) {
			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Menu actualizado satisfactoriamente.','data'=>$this->ConsultarMenuPorModulo()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el menu.');
			}else{
				return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Menu actualizado satisfactoriamente.','data'=>$this->ConsultarMenuPorModulo(Input::get('id_modulo'))) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el menu.');
			}
			

		} catch (Exception $e) {
			Excepciones::Crear($e,'MenuController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function ConsultarMenuPorModulo($id_modulo=null){

		if ($id_modulo==null) {
			$lista= Menus::all();
		}else{
			$lista= Menus::where('id_modulo','=',$id_modulo)->get();
			$modulo=Modulos::find($id_modulo);
		}		
		
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
		if ($id_modulo > 0) {
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
		}else{
			$menus=$menu;
		}

		return $menus;

	}

	public function ConsultarPorCodigo($id){

		$menu=Menus::find($id);

		return $menu;

	}

	public function Eliminar($id){

		if (Cookie::get('id_usuario')==null) {
			return "No puede eliminar";
		}

		$menu=Menus::find($id);
		$id_modulo=$menu->id_modulo;

		$menu->delete();
		if (Input::get('todos')>0) {
			return $this->ConsultarMenuPorModulo();
		}else{
			return $this->ConsultarMenuPorModulo($id_modulo);
		}
		

	}
	

}
