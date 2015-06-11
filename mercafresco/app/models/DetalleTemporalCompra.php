<?php

class DetalleTemporalCompra extends Eloquent {
	protected $table = 'detalle_temporal_compra';
	protected $primaryKey='ID';		
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;


}