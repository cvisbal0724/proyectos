<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Alcaldes;
use File;
use Input;
use Cookie;

class AlcaldeController extends Controller {

	public function Guardar(){
		try {
			
			$guardo=false;

			if (Input::get('id')>0) {
				
				$alcalde=Alcaldes::find(Input::get('id'));

				$nombreArchivo='';
				
				if (Input::hasFile('foto')) {
					if (Input::file('foto')->isValid()) {
						
						$nombreArchivo=rand(11111,99999).str_replace(' ','',Input::get('nombre')).'.'.
						Input::file('foto')->getClientOriginalExtension();

						$move=Input::file('foto')->move(
					        public_path() . '/app_cliente/fotos_alcalde/', $nombreArchivo
					    );

						if ($alcalde->foto!='') {
							File::delete(public_path().'/app_cliente/fotos_alcalde/'.$alcalde->foto);
						}

						$alcalde->foto=$nombreArchivo;	

					}
				}

				$alcalde->nombre=Input::get('nombre');
				$alcalde->id_partido=Input::get('id_partido');
				$alcalde->numero=Input::get('numero');
				$rs=$alcalde->save();
				
				$guardo=$rs > 0;

			}else{

				$nombreArchivo='';

				if (Input::hasFile('foto')) {
					if (Input::file('foto')->isValid()) {
						$nombreArchivo=rand(11111,99999).str_replace(' ','',Input::get('nombre')).'.'.
						Input::file('foto')->getClientOriginalExtension();

						 Input::file('foto')->move(
					        base_path() . '/public/app_cliente/fotos_alcalde/', $nombreArchivo
					    );
					}
				}
				
				$rs=Alcaldes::create(array(
				'nombre'=>Input::get('nombre'),
				'id_partido'=>Input::get('id_partido'),
				'numero'=>Input::get('numero'),
				'foto'=>$nombreArchivo
				));

				$guardo=$rs['id'] > 0;
				

			}
			

			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Alcalde guardado satisfactoriamente.','data'=>Alcaldes::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el alcalde.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'AlcaldeController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(){
		return Alcaldes::all();
	}

	public function ConsultarPorCodigo($id){

		$alcalde=Alcaldes::find($id);

		return $alcalde;


	}

}
