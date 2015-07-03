<?php

class CategoriaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /categoria
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function ObtenerTodos(){

		$lista=DB::table('producto as p')
		->join('categoria as c','p.id_categoria','=','c.id')
		->join('productos_proveedor as pp','pp.id_producto','=','p.id')
		->whereRaw('pp.inventario > 0')
		->select(DB::raw('c.ID,c.NOMBRE'))
		->groupBy('p.id_categoria')
		->get();
		return $lista;//Categoria::all();
	}

}