<?php

class BarrioPersonaController extends BaseController {

	public function Crear(){

		$usuario=Session::get('usuario');

 		$rs=BarrioPersona::create(array(

		"ID_PERSONA"=>$usuario->ID_PERSONA,
		"ID_BARRIO"=>Input::get("id_barrio"),
		"NOMBRE_SITIO"=>Input::get("nombre_sitio"),
		"DIRECCION"=>Input::get("direccion"),
		"TELEFONO"=>Input::get("telefono"),
		"QUIEN_RECIBE"=>Input::get("quien_recibe"),
		"ESTADO"=>1,
		"FECHA_CREACION"=>DB::raw('NOW()')

	 	));
 
 	return $rs["ID"];
 
 }
 
 
public function Modificar(){
 
 $id=Input::get("id");
 $usuario=Session::get('usuario');

  $barrio_persona=BarrioPersona::find($id);

$barrio_persona->ID=Input::get("id"); 
$barrio_persona->TELEFONO=Input::get("telefono");
$barrio_persona->QUIEN_RECIBE=Input::get("quien_recibe");
$barrio_persona->FECHA_MODIFICACION=DB::raw('NOW()');
$barrio_persona->ID_PERSONA=$usuario->ID_PERSONA;
$barrio_persona->ID_BARRIO=Input::get("id_barrio");
$barrio_persona->NOMBRE_SITIO=Input::get("nombre_sitio");
$barrio_persona->DIRECCION=Input::get("direccion");
$rs=$barrio_persona->save();
 return $rs > 0 ? 'true' : 'false';
 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $barrio_persona=BarrioPersona::find($id);
 $rs=$barrio_persona->delete();
 
 }
 
 
public function ObtenerPorID(){
 
 $id=Input::get("id");
 $row= BarrioPersona::find($id);
 
 $direccion=array(
	'id'=>$row->ID,
	'id_barrio'=>$row->ID_BARRIO,
	'nombre_sitio'=>$row->NOMBRE_SITIO,
	'direccion'=>$row->DIRECCION,
	'telefono'=>$row->TELEFONO,
	'quien_recibe'=>$row->QUIEN_RECIBE
 ); 

return $direccion;

 }

 
 
public function ObtenerTodos(){
 
 return BarrioPersona::all()->toJSON();
 
 }
 
 public function ObtenerPorPersona(){
 	$id_user=Cookie::get('id_user');
 	$usuario=Usuario::find($id_user);
 	$proveedorBarrio=DB::select('select id_barrio from barrio_proveedor group by id_barrio');
 	
 	$vector=array();
 	foreach ($proveedorBarrio as $key => $row) {
 		$vector[$key]=$row->id_barrio;
 	}
 	$lista=BarrioPersona::where('ID_PERSONA', $usuario->ID_PERSONA)->where('ESTADO',1)->whereIn('ID_BARRIO',$vector)->get()->toJSON(); 	
 	return $lista;
 }

public function SeleccionarDireccion(){
	$id_direccion=Input::get('id_direccion');
	Session::put('id_direccion',$id_direccion);
	$id=Session::get('id_direccion');
	return $id;
}

public function QuitarDireccion(){

	$id=Input::get("id"); 
  	$barrio_persona=BarrioPersona::find($id);

  	$barrio_persona->ESTADO=0;
  	$barrio_persona->save();
  	
 	return 1;

}

}