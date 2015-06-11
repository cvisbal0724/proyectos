<?php

class Unidad extends \Eloquent {
	protected $table = 'unidad';
	protected $primaryKey='ID';
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
}