<?php

class Pais extends \Eloquent {
	protected $table = 'pais';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
		
}