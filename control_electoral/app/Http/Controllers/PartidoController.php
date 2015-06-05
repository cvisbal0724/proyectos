<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Partidos;

class PartidoController extends Controller {

	
	public function Crear(Request $request){
		try {
			
			$guardo=false;

			$result=Partidos::where('nombre','=',$request->input('nombre'))->get();

			if ($request->input('id')==0 && count($result)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El partido ya existe, por favor ingrese uno nuevo.');				
			}
			if ($request->input('id')>0) {
				
				$part=Partidos::find($request->input('id'));
				$part->nombre=$request->input('nombre');
				$rs=$part->save();
				
				$guardo=$rs > 0;

			}else{
				$rs=Partidos::create(array(
				'nombre'=>$request->input('nombre')
				));

				$guardo=$rs['id'] > 0;
			}
			

			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Partido guardado satisfactoriamente.','data'=>Partidos::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guadar el partido.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'PartidoController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function Consultar(){
		return Partidos::all();
	}

	public function ConsultarPorCodigo($id){

		$part=Partidos::find($id);

		return array('id'=>$part->id,'nombre'=>$part->nombre,'_token'=>csrf_token());
	}

}
