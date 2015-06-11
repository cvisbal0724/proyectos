<?php

class BarrioProveedorController extends \BaseController {

	public function ObtenerTodos(){
		
		$lista=DB::table('barrio_proveedor')
		->join('barrio','barrio_proveedor.id_barrio','=','barrio.id')
		->select(DB::raw('barrio.id,barrio.nombre,coordenada_x,coordenada_y'))
		->groupBy('barrio.id')->get();
		return $lista;

	}

}