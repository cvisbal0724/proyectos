<?php

class HistorialCompra extends \Eloquent {
	protected $table = 'historial_compra';
	protected $primaryKey='ID';
	protected $with = array('ProductoProveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function OrdenServicio(){
		return $this->belongsTo('OrdenServicio', 'ID_ORDEN_SERVICIO','ID');
	}

	public function ProductoProveedor(){

		return $this->belongsTo('ProductosProveedor', 'ID_PRODUCTO_PROVEEDOR','ID');		
		
	}
}