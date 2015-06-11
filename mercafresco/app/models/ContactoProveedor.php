<?php

class ContactoProveedor extends \Eloquent {
	protected $table = 'contacto_proveedor';
	protected $primaryKey='ID';
	protected $with = array('Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}
}