<?php

class Persona extends \Eloquent {
	protected $table = 'persona';
	protected $primaryKey='ID';
	protected $with = array('Municipio','TipoIdentificacion');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Municipio(){
		return $this->belongsTo('Municipio', 'ID_MUNICIPIO','ID');
	}

	public function TipoIdentificacion(){
		return $this->belongsTo('TipoIdentificacion', 'ID_TIPO_IDENTIFICACION','ID');
	}

	public function Nombre_Completo(){
		return $this->NOMBRES . ' ' . $this->APELLIDOS;
	}

}