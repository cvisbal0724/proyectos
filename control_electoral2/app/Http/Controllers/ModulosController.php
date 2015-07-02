<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Modulos;

class ModulosController extends Controller {

	public function Guardar(Request $request){
		try {
			
			$guardo=false;

			$result=Modulos::where('nombre','=',$request->input('nombre'))->get();

			if ($request->input('id')==0 && count($result)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El modulo ya existe, por favor ingrese uno nuevo.');				
			}
			if ($request->input('id')>0) {
				
				$mod=Modulos::find($request->input('id'));

				$mod->nombre=$request->input('nombre');
				$rs=$mod->save();
				
				$guardo=$rs > 0;

			}else{
			
				$rs=Modulos::create(array(
				'nombre'=>$request->input('nombre')				
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

		return array(
			'id'=>$modulo->id,
			'nombre'=>$modulo->nombre,
			'_token'=>csrf_token()
		);		
	}

	public function EliminarModulo(Request $request){

		$mod=Modulos::find($request->input('id'));

		$mod->delete();

		return Modulos::all();
	}

}
