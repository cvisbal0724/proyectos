<?php

class VetoPersona extends \Eloquent {
	protected $table = 'veto_persona';
	protected $primaryKey='ID';
	protected $with = array('Usuario','Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Usuario(){
		return $this->belongsTo('Usuario', 'ID_USUARIO','ID');
	}

	public function Proveedor(){
		return $this->belongsTo('Proveedor', 'ID_PROVEEDOR','ID');
	}

}