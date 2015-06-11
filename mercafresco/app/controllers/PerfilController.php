<?php

class PerfilController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /perfil
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function Crear(){

	 $rs=Perfil::create(array( 
	"FECHA_REGISTRO"=>date("Y-m-d H:i:s"),
	"NOMBRE"=>Input::get("nombre"),
	));
 
 return $rs["ID"];
 
 }
 
 
public function Modificar(){
 
 $id=Input::get("id");
 
  $perfil=Perfil::find($id);
$perfil->FECHA_MODIFICACION=date("Y-m-d H:i:s");
$perfil->NOMBRE=Input::get("nombre");
$perfil->FECHA_REGISTRO=Input::get("fecha_registro");
$rs=$perfil->save();
 return $rs > 0 ? true : false;
 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $perfil=Perfil::find($id);
 $rs=$perfil->delete();
 
 }
 
 
public function ObtenerPoID(){
 
 $id=Input::get("id");
 return Perfil::find($id)->toJSON();
 
 }
 
 
public function ObtenerTodos(){
 
 return Perfil::all()->toJSON();
 
 }
 
 

}