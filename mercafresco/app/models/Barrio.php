<?php

class Barrio extends \Eloquent {
	protected $table = 'barrio';
	protected $primaryKey='ID';
	protected $with = array('Municipio');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Municipio(){
		return  $this->belongsTo('Municipio','ID_MUNICIPIO', 'ID');
	}

}