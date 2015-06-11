<?php

class TipoIdentificacion extends \Eloquent {
	protected $table = 'tipo_identificacion';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;	
}