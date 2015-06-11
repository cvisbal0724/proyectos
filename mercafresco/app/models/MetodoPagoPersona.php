<?php

class MetodoPagoPersona extends \Eloquent {
	protected $table = 'metodo_pago_persona';
	protected $primaryKey='ID';
	protected $with = array('Persona','TipoMetodoPago');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function TipoMetodoPago(){
		return $this->belongsTo('TipoMetodoPago', 'ID_TIPO_METODO_PAGO','ID');
	}

	public function Persona(){
		return $this->belongsTo('Persona', 'ID_PERSONA','ID');
	}
}