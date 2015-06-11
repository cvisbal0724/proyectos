<?php

class EmpresaConvenio extends \Eloquent {
	protected $table = 'empresa_convenio';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}