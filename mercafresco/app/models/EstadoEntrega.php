<?php

class EstadoEntrega extends \Eloquent {
	protected $table = 'estado_entrega';
	protected $primaryKey='ID';
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}