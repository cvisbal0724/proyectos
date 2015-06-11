<?php

class DiasFestivos extends \Eloquent {
	protected $table = 'dias_festivos';
	protected $primaryKey='ID';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}