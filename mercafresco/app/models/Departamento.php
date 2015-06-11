<?php

class Departamento extends \Eloquent {
	protected $table = 'departamento';
	protected $primaryKey='ID';
	protected $with = array('Pais');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Pais(){
		return $this->belongsTo('Pais', 'ID_PAIS','ID');
	}
	
}