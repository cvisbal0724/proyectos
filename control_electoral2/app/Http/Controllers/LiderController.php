<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\models\Lideres;
use App\models\LiderConcejales;
use App\models\Concejales;
use DB;
use App\Enums\EnumPerfiles;
use File;
use Input;
use App\models\Usuarios;
use Cookie;
use App\models\LiderEntregado;

class LiderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Cookie::get('id_usuario')>0) {
			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			return view('lideres/lider',array('usuario'=>$usuario));
		}else{
			return view('inicio/acceso_denegado');
		}
		
	}

	public function Crear(){
		DB::beginTransaction();
	try {

			$usuario=Usuarios::find(Cookie::get('id_usuario'));
			$lider=Lideres::where('id_persona','=',Input::get('id_persona'))->first();
			$nombreArchivo='';

			if ($lider) {
				return array('show'=>true,'alert'=>'warning','msg'=>'El lider ya existe.');
			}
			
			if (Input::hasFile('foto')) {
					if (Input::file('foto')->isValid()) {
						$nombreArchivo=rand(11111,99999).'.'.Input::file('foto')->getClientOriginalExtension();

						Input::file('foto')->move(
					        base_path() . '/public/app_cliente/fotos_lider/', $nombreArchivo
					    );

					 $imagePath=public_path() . '/app_cliente/fotos_lider/'. $nombreArchivo;
					 $image = Image::make($imagePath);
					 $image->resize(100, 100);
					 $image->save($imagePath);

					}
				}

		   $rs=Lideres::create(array(		   	   
			   'id_persona'=>Input::get('id_persona'),
			   'id_encargado'=>$usuario->id,
			   'foto'=>$nombreArchivo			
		   ));
			
			$concejal=Concejales::where('id_persona','=',$usuario->persona->id)->get();
			if (count($concejal)>0) {
				// LiderConcejales::create(array(
			   	//'meta'=>Input::get('meta'),
			   	//'id_lider'=>$rs['id'],
			   	//'id_concejal'=>$concejal[0]->id
			   	//));

				$liderConcejalArray[]=array(
					'meta'=>0,	
					'id_lider'=>$rs['id'],
					'id_concejal'=>$concejal[0]->id
				);	

				DB::table('lider_concejales')->insert($liderConcejalArray);

			}
		  
	   		DB::commit();

		  return $rs['id'] > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Lider guardado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo guardar el lider.');
			
		} catch (Exception $e) {
			DB::rollback();
			Excepciones::Crear($e,'LiderController','Crear');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Actualizar(){
	try {

			$lider=Lideres::find(Input::get('id'));
			$nombreFotoAnterior='';
			$nombreArchivo='';

			if (Input::hasFile('foto')) {
					if (Input::file('foto')->isValid()) {
						
						$nombreArchivo=rand(11111,99999).'.'.Input::file('foto')->getClientOriginalExtension();

						$move=Input::file('foto')->move(
					        public_path() . '/app_cliente/fotos_lider/'. $nombreArchivo
					    );
						
						$nombreFotoAnterior=$lider->foto;
						$lider->foto=$nombreArchivo;	

						$imagePath=public_path() . '/app_cliente/fotos_lider/'. $nombreArchivo;
						$image = Image::make($imagePath);
						$image->resize(100, 100);
						$image->save($imagePath);
					}
			}

			$lider->id_persona=Input::get('id_persona');
			$rs=$lider->save();

			if ($nombreFotoAnterior!='') {
				if (File::exists(public_path().'/app_cliente/fotos_lider/'.$nombreFotoAnterior)) {
					File::delete(public_path().'/app_cliente/fotos_lider/'.$nombreFotoAnterior);
				}				 
			}

			$concejal=Concejales::where('id_persona','=',Input::get('id_persona'))->first();
			
			$liderConcejal=LiderConcejales::where('id_concejal','=',$concejal->id)->where('id_lider','=',$lider->id)->first();
			$liderConcejal->meta=Input::get('meta');
			$liderConcejal->save();

			return $rs > 0 ? array('show'=>true,'alert'=>'success','msg'=>'Lider actualizado satisfactoriamente.') :
					array('show'=>true,'alert'=>'warning','msg'=>'No se pudo actualizar el lider.');
			
		} catch (Exception $e) {
			Excepciones::Crear($e,'LiderController','Actualizar');
			return array('show'=>true,'alert'=>'warning','msg'=>$e->getMessage());;
		}
}


public function Consultar(){
		try {
			$usuario=Usuarios::find(Cookie::get('id_usuario'));

		$criterio=Input::get('criterio');
		$lista=array();
		
		$consulta=DB::table('lideres as l')
			->join('personas as p','l.id_persona','=','p.id')			
			->join('usuarios as u','l.id_encargado','=','u.id')
			->join('personas as p2','u.id_persona','=','p2.id')
			->join('alcaldes as al','p.id_alcalde','=','al.id')
			->leftJoin('lider_concejales as lc','lc.id_lider','=','l.id')
			->leftJoin('concejales as c','lc.id_concejal','=','c.id')
			->leftJoin('personas as p3','c.id_persona','=','p3.id')
			->select(DB::raw("l.id,ifnull(lc.meta,'N/A') as meta,concat(p.nombre,' ',p.apellido) as lider,
			concat(p2.nombre,' ',p2.apellido) as encargado,ifnull(concat(p3.nombre,' ', p3.apellido),'N/A') as concejal,
			al.nombre as alcalde,(select count(v.id) from votantes v where v.id_lider=l.id) as votos,
			(select sum(le.valor) from lider_entregado as le where le.id_lider=l.id) as total_entregado"))
			->groupBy(DB::raw('lc.meta,p.cedula,p2.cedula,p3.cedula'));
		$paginado=10;

			if ($usuario->id_perfil==EnumPerfiles::Administrador) {
				$consulta=$consulta->where('p.id_alcalde','=',$usuario->persona->id_alcalde);				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Alcalde) {						
				$consulta=$consulta->whereRaw('p.id_alcalde=? and l.id_encargado=?',array($usuario->persona->id_alcalde,$usuario->id));				
			}
			else if ($usuario->id_perfil==EnumPerfiles::Concejal) {
				$consulta=$consulta->whereRaw('p.id_alcalde=? and l.id_encargado=?',array($usuario->persona->id_alcalde,$usuario->id));			
			}
			else if ($usuario->id_perfil==EnumPerfiles::Lider) {
				$consulta=$consulta->whereRaw('p.id_alcalde=? and l.id_encargado=?',array($usuario->persona->id_alcalde,$usuario->id));
			}

		if ($criterio=='') {
			$lista=$consulta->orderBy('p.nombre','asc')->take(100)->paginate($paginado);
		}
		else{
			$lista=$consulta->whereRaw(" concat(p.nombre ,' ', p.apellido) like ?",array('%'.$criterio.'%'))
			->orderBy('p.nombre','asc')->paginate($paginado);
		}

		return $lista;
		} catch (Exception $e) {
			return $e;
		}		
	}

public function ConsultarPorCodigo($id){

	$concejal=Lideres::find($id);
	
	return $concejal;
}

public function AgregarLiderConcejales(){
	try {

		$lista=Input::get('listaConcejales');
		//dd($lista);
		//exit();
		$liderConcejalArray=array();
		foreach ($lista as $key => $item) {
			$liderConc=LiderConcejales::where('id_lider','=',$item['id_lider'])->where('id_concejal','=',$item['id_concejal'])->get();			
			if (count($liderConc)==0) {

				$liderConcejalArray[]=array(
					'meta'=>$item['meta'],
					'id_lider'=>$item['id_lider'],
					'id_concejal'=>$item['id_concejal'],
				);	
				
				/*$liderConcejal= new LiderConcejales();
				
				$liderConcejal->meta=$item['meta'];
				$liderConcejal->id_lider=$item['id_lider'];
				$liderConcejal->id_concejal=$item['id_concejal'];
				
				$liderConcejal->save();*/

			}			
		}
		if (count($liderConcejalArray)>0) {
			DB::table('lider_concejales')->insert($liderConcejalArray);
		}		

		return LiderConcejales::where('id_lider','=',$lista[0]['id_lider'])->get();	
	} catch (Exception $e) {
		
	}	
}

public function ConsultarLiderConcejales(){
	return LiderConcejales::where('id_lider','=',Input::get('id_lider'))->get();
}

public function EliminarLiderConcejales(){
	try {

		 //return $request->input();
	//exit();
	$obj=LiderConcejales::where('id_lider','=',Input::get('id_lider'))
	->where('id_concejal','=',Input::get('id_concejal'))->delete();
	
	return LiderConcejales::where('id_lider','=',Input::get('id_lider'))->get();

	} catch (Exception $e) {
		return $e;
	}
  	
}

public function GuardarEntregas(){
	try {
		
		$guardo=false;

		if (Input::get('id')>0) {

			$item=LiderEntregado::find(Input::get('id'));

			$item->valor=Input::get('valor');
			$item->observacion=Input::get('observacion');
			$rs=$item->save();

			$guardo=$rs>0;

		}else{
		
			$rs=LiderEntregado::create(array(
				'id_lider'=>Input::get('id_lider'),
				'id_usuario'=>Cookie::get('id_usuario'),
				'observacion'=>Input::get('observacion'),
				'valor'=>Input::get('valor')
			));

			$guardo=$rs['id']>0;

		}

		return $guardo ? array('show'=>true,'alert'=>'success','msg'=>'Se registro ha satisfactoriamente el valor entregado.','data'=>LiderEntregado::all()) :
					array('show'=>true,'alert'=>'warning','msg'=>'Hubo un error al guardar.');

	} catch (Exception $e) {
		return array('show'=>true,'alert'=>'error','msg'=>$e->getMessage());
	}
}

public function ObtenerEntregas()
{
	return LiderEntregado::all();
}

public function ObtenerEntregasPorCodigo()
{
	return LiderEntregado::find(Input::get('id'));
}

public function EliminarEntregas(){

	$obj=LiderEntregado::find(Input::get('id'));
	$obj->delete();
	return LiderEntregado::all();
}

}

