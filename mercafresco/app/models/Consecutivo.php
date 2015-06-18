<?php

class Consecutivo extends \Eloquent {
	protected $table = 'consecutivo_orden_de_servicio';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}