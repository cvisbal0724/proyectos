<?php

class BarrioPersona extends \Eloquent {
	protected $table = 'barrio_persona';
	protected $primaryKey='ID';
	protected $with = array('Persona','Barrio');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Persona(){
		return $this->belongsTo('Persona','ID_PERSONA','ID');
	}

	public function Barrio(){
		return $this->belongsTo('Barrio','ID_BARRIO','ID');
	}

}