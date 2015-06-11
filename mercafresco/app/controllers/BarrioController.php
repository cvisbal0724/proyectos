<?php

class BarrioController extends BaseController {

	
	public function ObtenerTodos(){

		return Barrio::all()->toJSON();

	}


}