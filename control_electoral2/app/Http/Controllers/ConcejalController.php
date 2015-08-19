<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Concejales;
use App\models\Lideres;
use Auth;
use DB;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use Input;
use Cookie;
use App\models\Usuarios;
use App\models\ConcejalEntregado;

class ConcejalController extends Controller {

public function Crear(){
	DB::beginTransaction();
	try {

			$concejal=Concejales::where('id_persona','=',Input::get('id_persona'))->first();
			$nombreArchivo='';

			if ($concejal) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El concejal ya existe.');
			}
			
			if (Input::hasFile('foto')) {
				if (Input::file('foto')->isValid()) {
					$nombreArchivo=rand(11111,99999).'.'.Input::file('foto')->getClientOriginalExtension();
					 Input::file('foto')->move(
				        base_path() . '/public/app_cliente/fotos_concejal/', $nombreArchivo
				    );

					 $imagePath=public_path() . '/app_cliente/fotos_concejal/'. $nombreArchivo;
					 $image = Image::make($imagePath);
					 $image->resize(100, 100);
					 $image->save($imagePath);
				}
			}

			$rs=Concejales::create(array(
				'id_persona'=>Input::get('id_persona'),
				'id_usuario'=>Cookie::get('id_usuario'),//Auth::user()->id,
				'id_partido'=>Input::get('id_partido'),
				'numero'=>Input::get('numero'),
				'foto'=>$nombreArchivo
			));

			$lider=Lideres::where('id_persona','=',Input::get('id_persona'))->get();
			if (count($lider)==0) {
				Lideres::create(array(
				'id_persona'=>Input::get('id_persona'),
				'id_encargado'=>Cookie::get('id_usuario')//Auth::user()->id				
				));
			}

			DB::commit();
			
			return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Concejal guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el concejal.');
			
		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'ConcejalController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Actualizar(){
	try {

			$concejal=Concejales::find(Input::get('id'));
			$nombreFotoAnterior='';
			$nombreArchivo='';

			if (Input::hasFile('foto')) {
					if (Input::file('foto')->isValid()) {
						
						$nombreArchivo=rand(11111,99999).'.'.Input::file('foto')->getClientOriginalExtension();

						$move=Input::file('foto')->move(
					        public_path() . '/app_cliente/fotos_concejal/', $nombreArchivo
					    );
						
						$imagePath=public_path() . '/app_cliente/fotos_concejal/'. $nombreArchivo;
						$nombreFotoAnterior=$concejal->foto;
						$concejal->foto=$nombreArchivo;	
						$image = Image::make($imagePath);
						$image->resize(100, 100);
						$image->save($imagePath);
					}
			}

			$concejal->id_persona=Input::get('id_persona');			
			$concejal->id_partido=Input::get('id_partido');
			$concejal->numero=Input::get('numero');
			$rs=$concejal->save();

			if ($nombreFotoAnterior!='') {
				if (File::exists(public_path().'/app_cliente/fotos_concejal/'.$nombreFotoAnterior)) {
					File::delete(public_path().'/app_cliente/fotos_concejal/'.$nombreFotoAnterior);
				}				 
			}

			$lider=Lideres::where('id_persona','=',Input::get('id_persona'))->get();
			if (count($lider)==0) {
				Lideres::create(array(
				'id_persona'=>Input::get('id_persona'),
				'id_encargado'=>Input::get('id_usuario')				
				));
			}

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Concejal guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el concejal.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'ConcejalController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}

public function Consultar(){
		
		$criterio=Input::get('criterio');
		$usuario=Usuarios::find(Cookie::get('id_usuario'));
		$id_alcalde=$usuario->persona->id_alcalde;
		//Auth::user()->persona->id_alcalde;

		$lista=array();
		$consulta=DB::table('concejales as c')
			->join('personas as p','c.id_persona','=','p.id')
			->join('partidos as pt','c.id_partido','=','pt.id')
			->join('alcaldes as al','p.id_alcalde','=','al.id')
			->select(DB::raw("c.id, c.numero, concat(p.nombre, ' ', p.apellido) as concejal, pt.nombre as partido, al.nombre as alcalde,
				(select count(id) from votantes v where v.id_concejal=c.id) as votos,
				(select sum(ce.valor) from concejal_entregado as ce where ce.id_concejal=c.id) as total_entregado"));
		$paginado=10;
		if ($criterio=='') {
			$lista=$consulta->where('p.id_alcalde','=',$id_alcalde)->orderBy('p.nombre','asc')->take(100)->paginate($paginado);
		}
		else{
			$lista=$lista=$consulta->whereRaw("p.id_alcalde=? and (c.numero like ? or concat(p.nombre ,' ', p.apellido) like ? or pt.nombre like ?)",array($id_alcalde,'%'.$criterio.'%','%'.$criterio.'%','%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
		}

		return $lista;
	}

public function ConsultarPorCodigo($id){

	$concejal=Concejales::find($id);
	
	return $concejal;
}

public function GuardarEntregas(){
	try {
		
		$guardo=false;

		if (Input::get('id')>0) {

			$item=ConcejalEntregado::find(Input::get('id'));

			$item->valor=Input::get('valor');
			$item->observacion=Input::get('observacion');
			$rs=$item->save();

			$guardo=$rs>0;

		}else{
		
			$rs=ConcejalEntregado::create(array(
				'id_concejal'=>Input::get('id_concejal'),
				'id_usuario'=>Cookie::get('id_usuario'),
				'observacion'=>Input::get('observacion'),
				'valor'=>Input::get('valor')
			));

			$guardo=$rs['id']>0;

		}

		return $guardo ? array('show'=>true,'alert'=>'success','msg'=>'Se registro ha satisfactoriamente el valor entregado.','data'=>ConcejalEntregado::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'Hubo un error al guardar.');

	} catch (Exception $e) {
		return array('show'=>true,'alert'=>'error','msg'=>$e->getMessage());
	}
}

public function ObtenerEntregas()
{
	return ConcejalEntregado::all();
}

public function ObtenerEntregasPorCodigo()
{
	return ConcejalEntregado::find(Input::get('id'));
}

public function EliminarEntregas(){

	$obj=ConcejalEntregado::find(Input::get('id'));
	$obj->delete();
	return ConcejalEntregado::all();
}

}
