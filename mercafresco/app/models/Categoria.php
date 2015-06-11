<?php

class Categoria extends \Eloquent {
	protected $table = 'categoria';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}