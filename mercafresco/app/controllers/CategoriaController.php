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
		return Categoria::all();
	}

}