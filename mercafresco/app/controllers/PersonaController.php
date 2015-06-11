<?php

class PersonaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /persona
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function Crear(){
 $rs=Persona::create(array(
  
"NO_IDENTIFICACION"=>Input::get("no_identificacion"),
"CORTESIA"=>Input::get("cortesia"),
"NOMBRES"=>Input::get("nombres"),
"APELLIDOS"=>Input::get("apellidos"),
"TELEFONO"=>Input::get("telefono"),
"cedula"=>Input::get("cedula"),
"CELULAR"=>Input::get("celular"),
"nombre"=>Input::get("nombre"),
"EMAIL"=>Input::get("email"),
"ID_MUNICIPIO"=>Input::get("id_municipio"),
"apellido"=>Input::get("apellido"),
"FECHA_NACIMIENTO"=>Input::get("fecha_nacimiento"),
"ID_TIPO_IDENTIFICACION"=>Input::get("id_tipo_identificacion"),
"direccion"=>Input::get("direccion"),
"FECHA_REGISTRO"=>Input::get("fecha_registro"),
"created_at"=>Input::get("created_at"),
"FECHA_MODIFICACION"=>Input::get("fecha_modificacion"),
"updated_at"=>Input::get("updated_at"),
));
 
 return $rs["ID"];
 
 }
 
 
public function Modificar(){
 
 $id=Input::get("id");
 
    $persona=Persona::find($id);
	$persona->NO_IDENTIFICACION=Input::get("no_identificacion");
	$persona->cedula=Input::get("cedula");
	$persona->CORTESIA=Input::get("cortesia");
	$persona->nombre=Input::get("nombre");
	$persona->NOMBRES=Input::get("nombres");
	$persona->apellido=Input::get("apellido");
	$persona->APELLIDOS=Input::get("apellidos");
	$persona->direccion=Input::get("direccion");
	$persona->TELEFONO=Input::get("telefono");
	$persona->created_at=Input::get("created_at");
	$persona->CELULAR=Input::get("celular");
	$persona->updated_at=Input::get("updated_at");
	$persona->EMAIL=Input::get("email");
	$persona->ID_MUNICIPIO=Input::get("id_municipio");
	$persona->FECHA_NACIMIENTO=Input::get("fecha_nacimiento");
	$persona->ID_TIPO_IDENTIFICACION=Input::get("id_tipo_identificacion");
	$persona->FECHA_REGISTRO=Input::get("fecha_registro");
	$persona->FECHA_MODIFICACION=Input::get("fecha_modificacion");
	$rs=$persona->save();
 return $rs > 0 ? true : false;
 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $persona=Persona::find($id);
 $rs=$persona->delete();
 
 }
 
 
public function ObtenerPorID(){
 
 $id=Input::get("id");
 return Persona::find($id)->toJSON();
 
 }
 
 
public function ObtenerTodos(){
 
 return Persona::all()->toJSON();
 
 }
 
 

}