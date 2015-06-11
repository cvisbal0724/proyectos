<?php

class Funcionario extends Eloquent {
	protected $table = 'funcionario';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;	
}