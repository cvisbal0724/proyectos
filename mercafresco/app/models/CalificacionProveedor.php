<?php

class CalificacionProveedor extends \Eloquent {
	protected $table = 'calificacion_proveedor';
	protected $primaryKey='ID';
	protected $with = array('OrdenServicio','Proveedor','Usuario');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

	public function OrdenServicio(){
		return $this->belongsTo('OrdenServicio', 'ID_ORDEN_SERVICIO','ID');
	}

	public function Usuario(){
		return $this->belongsTo('Usuario', 'ID_USUARIO','ID');
	}

}