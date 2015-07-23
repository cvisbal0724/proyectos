<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Partidos;
use File;
use Input;

class PartidoController extends Controller {

	
	public function Guardar(){
		try {
			
			$guardo=false;

			$result=Partidos::where('nombre','=',Input::get('nombre'))->get();

			if (Input::get('id')==0 && count($result)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El partido ya existe, por favor ingrese uno nuevo.');				
			}
			if (Input::get('id')>0) {
				
				$part=Partidos::find(Input::get('id'));

				$nombreArchivo='';
				
				if (Input::hasFile('logo')) {
					if (Input::file('logo')->isValid()) {
						
						$nombreArchivo=rand(11111,99999).str_replace(' ','',Input::get('nombre')).'.'.
						Input::file('logo')->getClientOriginalExtension();

						$move=Input::file('logo')->move(
					        public_path() . '/app_cliente/logos_partido/', $nombreArchivo
					    );

						if ($part->logo!='') {
							File::delete(public_path().'/app_cliente/logos_partido/'.$part->logo);
						}

						$part->logo=$nombreArchivo;	

					}
				}

				$part->nombre=Input::get('nombre');
				$rs=$part->save();
				
				$guardo=$rs > 0;

			}else{

				$nombreArchivo='';

				if (Input::hasFile('logo')) {
					if (Input::file('logo')->isValid()) {
						$nombreArchivo=rand(11111,99999).str_replace(' ','',Input::get('nombre')).'.'.
						Input::file('logo')->getClientOriginalExtension();

						 Input::file('logo')->move(
					        base_path() . '/public/app_cliente/logos_partido/', $nombreArchivo
					    );
					}
				}
				
				$rs=Partidos::create(array(
				'nombre'=>Input::get('nombre'),
				'logo'=>$nombreArchivo
				));

				$guardo=$rs['id'] > 0;
				

			}
			

			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Partido guardado satisfactoriamente.','data'=>Partidos::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el partido.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'PartidoController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	}

	public function Consultar(){
		return Partidos::all();
	}

	public function ConsultarPorCodigo($id){

		$part=Partidos::find($id);

		return $part;
	}

public function Eliminar(){

		$part=Partidos::find(Input::get('id'));
		$nombreArchivo=$part->logo;				
		$part->delete();
		if (File::exists(public_path().'/app_cliente/logos_partido/'.$nombreArchivo)) {
			File::delete(public_path().'/app_cliente/logos_partido/'.$nombreArchivo);
		}
	}

}
