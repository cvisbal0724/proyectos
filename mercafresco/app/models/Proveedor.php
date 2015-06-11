<?php

class Proveedor extends \Eloquent {
	protected $table = 'proveedor';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
}