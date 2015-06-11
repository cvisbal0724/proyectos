<?php

class BarrioProveedor extends \Eloquent {
	protected $table = 'barrio_proveedor';
	protected $primaryKey='ID';
	protected $with = array('Proveedor','Barrio');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Barrio(){
		return $this->belongsTo('Barrio', 'ID_BARRIO','ID');
	}

	public function Proveedor(){
		return $this->belongsTo('Proveedor','ID_PROVEEDOR','ID');
	}

}