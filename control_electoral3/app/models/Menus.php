<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model {

	protected $table = 'menus';
	protected $primaryKey='id';
	//protected $with=array('modulo');
	protected $guarded = array();
	public static $rules = array();

	public function Modulo(){
		return $this->belongsTo('App\models\Modulos','id_modulo','id');
	}

}
