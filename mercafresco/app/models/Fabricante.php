<?php

class Fabricante extends \Eloquent {
	protected $table = 'fabricante';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}