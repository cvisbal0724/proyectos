<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Perfiles;
use App\models\PerfilModulos;
use App\models\Modulos;
use DB;
use Input;

class PerfilesController extends Controller {

	public function Guardar(){
		try {
			
			$guardo=false;			

			$result=Perfiles::where('nombre','=',Input::get('nombre'))->get();
			if (Input::get('id')==0 && count($result)>0) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El perfil ya existe, por favor ingrese uno nuevo.');				
			}

			if (Input::get('id')>0) {
				
				$perfil=Perfiles::find(Input::get('id'));

				$perfil->nombre=Input::get('nombre');
				$rs=$perfil->save();
				$guardo=$rs > 0;
			}else{
				$rs=Perfiles::create(array(
					'nombre'=>Input::get('nombre')
				));

				$guardo=$rs['id']>0;
			}
			
			return $guardo > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Perfil guardado satisfactoriamente.','data'=>Perfiles::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el perfil.');

		} catch (Exception $e) {
			Excepciones::Crear($e,'PerfilesController','Guardar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());
		}
	} 


	public function Consultar(){
		return Perfiles::all();
	}

	public function ConsultarPorCodigo($id){
		$perfil=Perfiles::find($id);

		return $perfil;
	}

	public function ConsultarModulo($id_perfil){

		$lista=PerfilModulos::where('id_perfil','=',$id_perfil)->get();

		return $lista;

	}

	public function AgregarModulos(){
		try {
			
			$lista=Input::get('listaModulos');

			PerfilModulos::insert($lista);

			/*$id_perfil=$lista[0]['id_perfil'];

			$lista=PerfilModulos::where('id_perfil','=',$id_perfil)->get();

			return $lista;*/

		} catch (Exception $e) {
			Excepciones::Crear($e,'PerfilesController','Guardar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
	}

	public function ConsultarModulosNoAgregados($id_perfil){

		$lista=PerfilModulos::where('id_perfil','=',$id_perfil)->select('id_modulo')->get();

		$arrayMod=array();
		foreach ($lista as $key => $mod) {
			$arrayMod[$key]=$mod->id_modulo;
		}

		$modulos=Modulos::whereNotIn('id',$arrayMod)->get();

		return $modulos;

	}

	public function EliminarPerfilModulo(){

		$pmod=PerfilModulos::find(Input::get('id_perfil_modulo'));

		$pmod->delete();
		
		/*$lista=PerfilModulos::where('id_perfil','=',$pmod->id_perfil)->get();
		
		return $lista;*/
	}

}
