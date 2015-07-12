<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Modulos;
use Input;

class ModulosController extends Controller {

	public function Guardar(){
		try {
			
			$guardo=false;

			$result=Modulos::where('nombre','=',Input::get('nombre'))->get();

			if (Input::get('id')==0 && count($result)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El modulo ya existe, por favor ingrese uno nuevo.');				
			}
			if (Input::get('id')>0) {
				
				$mod=Modulos::find(Input::get('id'));

				$mod->nombre=Input::get('nombre');
				$rs=$mod->save();
				
				$guardo=$rs > 0;

			}else{
			
				$rs=Modulos::create(array(
				'nombre'=>Input::get('nombre')				
				));

				$guardo=$rs['id'] > 0;
				

			}
			

			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Modulo guardado satisfactoriamente.','data'=>Modulos::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el partido.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'ModulosController','Guardar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(){
		return Modulos::all();
	}
	
	public function ConsultarPorCodigo($id){
		$modulo=Modulos::find($id);

		return $modulo;
	}

	public function EliminarModulo(){

		$mod=Modulos::find(Input::get('id'));

		$mod->delete();

		return Modulos::all();
	}

}
