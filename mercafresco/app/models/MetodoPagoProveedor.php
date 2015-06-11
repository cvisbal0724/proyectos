<?php

class MetodoPagoProveedor extends \Eloquent {
	protected $table = 'metodo_pago_proveedor';
	protected $primaryKey='ID';
	protected $with = array('MetodoPago','Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

	public function MetodoPago(){
		return $this->belongsTo('MetodoPago', 'ID_METODO_PAGO','ID');
	}
}