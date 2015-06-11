<?php

class TipoPQR extends \Eloquent {
	protected $table = 'tipo_pqr';
	protected $primaryKey='ID';
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}