<?php

class Iva extends \Eloquent {
	protected $table = 'iva';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
}