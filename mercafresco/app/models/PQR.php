<?php

class PQR extends \Eloquent {
	protected $table = 'pqr';
	protected $primaryKey='ID';
	protected $with = array('TipoPQR');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function TipoPQR(){
		return $this->belongsTo('TipoPQR', 'ID_TIPO_PQR','ID');
	}
	
}