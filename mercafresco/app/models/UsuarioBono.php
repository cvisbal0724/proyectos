<?php

class UsuarioBono extends \Eloquent {
	protected $table = 'usuario_bono';
	//protected $primaryKey='ID';
	//protected $with = array('Usuario','Proveedor');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}