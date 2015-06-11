<?php

class EstadoPago extends \Eloquent {
	protected $table = 'estado_pago';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}