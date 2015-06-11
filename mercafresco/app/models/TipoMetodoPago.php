<?php

class TipoMetodoPago extends \Eloquent {
	protected $table = 'tipo_metodo_pago';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}