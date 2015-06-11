<?php

class ProductoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /producto
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function Crear(){

 	$rs=Producto::create(array(  
	"ESTADO"=>Input::get("estado"),
	"ID"=>Input::get("id"),
	"ID_CATEGORIA"=>Input::get("id_categoria"),
	"NOMBRE"=>Input::get("nombre")	
	));
 
 	return $rs["ID"];
 
 }
 
 
public function Modificar(){
 
    $id=Input::get("id");
 
  	$producto=Producto::find($id);
	$producto->ID=Input::get("id");
	$producto->ID_CATEGORIA=Input::get("id_categoria");
	$producto->NOMBRE=Input::get("nombre");	
	$producto->FECHA_MODIFICACION=Input::get("fecha_modificacion");
	$producto->ESTADO=Input::get("estado");
	$rs=$producto->save();
 	return $rs > 0 ? true : false;
 
 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $producto=Producto::find($id);
 $rs=$producto->delete();
 
 }
 
 
public function ObtenerPoID(){
 
 $id=Input::get("id");
 return Producto::find($id)->toJSON();
 
 }
 
 
 public function ObtenerTodos(){
 
 return Producto::all()->toJSON();
 
 }
 
 

}