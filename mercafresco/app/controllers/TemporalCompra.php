<?php

class TemporalCompra extends Eloquent {
	protected $table = 'temporal_compra';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Detalle(){
		return $this->hasMany('DetalleTemporalCompra','ID_TEMPORAL_COMPRA','ID');
	}

}