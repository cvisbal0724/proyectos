<?php

class TipoBono extends \Eloquent {
	protected $table = 'tipo_bono';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}