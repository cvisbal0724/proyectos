<?php

class ProductosProveedor extends Eloquent {
	protected $table = 'productos_proveedor';
	protected $primaryKey='ID';
	protected $with = array('Proveedor','Producto','Fabricante','Unidad','Iva');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

	public function Producto(){
		return $this->belongsTo('Producto', 'ID_PRODUCTO','ID');
	}

	public function Fabricante(){
		return $this->belongsTo('Fabricante', 'ID_FABRICANTE','ID');
	}

	public function Unidad(){
		return $this->belongsTo('Unidad', 'ID_UNIDAD','ID');
	}

	public function Iva(){
		return $this->belongsTo('Iva', 'ID_IVA','ID');
	}		

}