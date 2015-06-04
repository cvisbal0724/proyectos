<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Excepciones;
use App\models\Partidos;

class PartidoController extends Controller {

	
	public function Crear(Request $request){
		try {
			
			$result=Partidos::where('nombre','=',$request->input('nombre'));

			/*if ($result) {
				return 'El partido ya existe, por favor ingrese uno nuevo.';
			}*/

			$rs=Partidos::create(array(
				'nombre'=>$request->input('nombre')
			));

			return $rs['id'] > 0 ? 'Success' : 'Error';

		} catch (Exception $e) {
			Excepciones::Crear($e,'PartidoController','Crear');
			return $e->getMessage();
		}
	}

}
