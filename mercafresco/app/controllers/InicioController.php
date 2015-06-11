<?php

class InicioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /inicio
	 *
	 * @return Response
	 */

	public function index()
	{		
		 return View::make('inicio/index');
	}	

	public function inicio($id_categoria)
	{
		 return View::make('inicio/index', array('id_categoria'=>$id_categoria));	
	}
	
	/**
	 * Show the form for creating a new resource.
	 * GET /inicio/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /inicio
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /inicio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /inicio/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /inicio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /inicio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}