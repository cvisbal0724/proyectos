<?php

class Factura extends \Eloquent {
	protected $table = 'factura';
	protected $primaryKey='ID';
	protected $with = array('TipoBono','Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function OrdenServicio(){
		return $this->belongsTo('OrdenServicio', 'ID_ORDEN_SERVICIO','ID');
	}

}