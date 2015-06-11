<?php

class Municipio extends \Eloquent {
	protected $table = 'municipio';
	protected $primaryKey='ID';
	protected $with = array('Departamento');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Departamento(){
		return $this->belongsTo('Departamento', 'ID_DEPARTAMENTO','ID');
	}
	
}