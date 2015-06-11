<?php

class Bonos extends \Eloquent {
	protected $table = 'bonos';
	protected $primaryKey='ID';
	protected $with = array('TipoBono','Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function TipoBono(){
		return $this->belongsTo('TipoBono', 'ID_TIPO_BONO','ID');
	}

	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

}