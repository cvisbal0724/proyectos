<?php

class Empresa extends \Eloquent {
	protected $table = 'empresa';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	
}