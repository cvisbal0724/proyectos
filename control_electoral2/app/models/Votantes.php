<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Votantes extends Model {

	protected $table = 'votantes';
	protected $primaryKey='id';
	protected $with=array('persona');
	protected $guarded = array();
	public static $rules = array();

	public function Persona(){
		return $this->belongsTo('App\models\Personas','id_persona','id');
	}

}
