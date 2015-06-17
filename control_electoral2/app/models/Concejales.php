<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Concejales extends Model {

	protected $table = 'concejales';
	protected $primaryKey='id';
	protected $with=array('partido','persona');
	protected $guarded = array();
	public static $rules = array();

	public function Partido(){
		return $this->belongsTo('App\models\Partidos','id_partido','id');
	}

	public function Persona(){
		return $this->belongsTo('App\models\Personas','id_persona','id');
	}

}
