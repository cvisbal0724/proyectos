<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model {

	protected $table = 'personas';
	protected $primaryKey='id';
	protected $with=array('alcalde');
	protected $guarded = array();
	public static $rules = array();

	public function Alcalde(){
		return $this->belongsTo('App\models\Alcaldes','id_alcalde','id');
	}

	public function nombre_completo(){
		return $this->nombre . ' ' . $this->apellido;
	}
}
