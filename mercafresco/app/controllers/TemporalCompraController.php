<?php

class TemporalCompraController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /temporalcompra
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function Crear(){

	 $rs=TemporalCompra::create(array(	  
	"ID_USUARIO"=>Input::get("id_usuario"),	
	"ID_PRODUCTO_PROVEEDOR"=>Input::get("id_producto_proveedor"),
	"CANTIDAD"=>Input::get("cantidad"),
	"FECHA_INGRESO"=>DB::raw('NOW()')
	));
	 
	 return $rs["ID"]; 
  }
 
 
	public function Modificar(){
	 
	 $id=Input::get("id");
	 
	  $temporal_compra=TemporalCompra::find($id);
	$temporal_compra->FECHA_INGRESO=Input::get("fecha_ingreso");
	$temporal_compra->ID_PRODUCTO_PROVEEDOR=Input::get("id_producto_proveedor");
	$temporal_compra->CANTIDAD=Input::get("cantidad");
	$temporal_compra->ID_USUARIO=Input::get("id_usuario");
	$rs=$temporal_compra->save();
	 return $rs > 0 ? true : false;
	 
	 }
 
 
public function Eliminar(){
 
 $id=Input::get("id");
 
 $temporal_compra=TemporalCompra::find($id);
 $rs=$temporal_compra->delete();
 
 }
 
 
public function ObtenerPoID(){
 
 $id=Input::get("id");
 return temporal_compra::find($id)->toJSON();
 
 }
 
 
public function ObtenerTodos(){
 
 return temporal_compra::all()->toJSON();
 
 }
 
 
 
	
}