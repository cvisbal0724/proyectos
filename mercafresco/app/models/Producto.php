<?php

class Producto extends \Eloquent {
	protected $table = 'producto';
	protected $primaryKey='ID';
	protected $with = array('Categoria');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Categoria(){
		return $this->belongsTo('Categoria', 'ID_CATEGORIA','ID');
	}
}