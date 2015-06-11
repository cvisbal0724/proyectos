<?php

class Perfil extends \Eloquent {
	protected $table = 'perfil';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;	
	
}