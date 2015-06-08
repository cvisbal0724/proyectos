<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Alcaldes;
use File;

class AlcaldeController extends Controller {

	public function Guardar(Request $request){
		try {
			
			$guardo=false;

			if ($request->input('id')>0) {
				
				$alcalde=Alcaldes::find($request->input('id'));

				$nombreArchivo='';
				
				if ($request->hasFile('foto')) {
					if ($request->file('foto')->isValid()) {
						
						$nombreArchivo=rand(11111,99999).str_replace(' ','',$request->input('nombre')).'.'.
						$request->file('foto')->getClientOriginalExtension();

						$move=$request->file('foto')->move(
					        public_path() . '/app_cliente/fotos_alcalde/', $nombreArchivo
					    );

						if ($alcalde->foto!='') {
							File::delete(public_path().'/app_cliente/fotos_alcalde/'.$alcalde->foto);
						}

						$alcalde->foto=$nombreArchivo;	

					}
				}

				$alcalde->nombre=$request->input('nombre');
				$alcalde->id_partido=$request->input('id_partido');
				$alcalde->numero=$request->input('numero');
				$rs=$alcalde->save();
				
				$guardo=$rs > 0;

			}else{

				$nombreArchivo='';

				if ($request->hasFile('logo')) {
					if ($request->file('logo')->isValid()) {
						$nombreArchivo=rand(11111,99999).str_replace(' ','',$request->input('nombre')).'.'.
						$request->file('logo')->getClientOriginalExtension();

						 $request->file('logo')->move(
					        base_path() . '/public/app_cliente/fotos_alcalde/', $nombreArchivo
					    );
					}
				}
				
				$rs=Alcaldes::create(array(
				'nombre'=>$request->input('nombre'),
				'id_partido'=>$request->input('id_partido'),
				'numero'=>$request->input('numero'),
				'foto'=>$nombreArchivo
				));

				$guardo=$rs['id'] > 0;
				

			}
			

			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Alcalde guardado satisfactoriamente.','data'=>Alcaldes::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el alcalde.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'AlcaldeController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function Consultar(){
		return Alcaldes::all();
	}

	public function ConsultarPorCodigo($id){

		$alcalde=Alcaldes::find($id);

		return array('id'=>$alcalde->id,'nombre'=>$alcalde->nombre,
			'id_partido'=>$alcalde->id_partido,'numero'=>$alcalde->numero,'_token'=>csrf_token());


	}

}
