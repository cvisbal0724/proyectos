<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Votantes extends Model {

	protected $table = 'votantes';
	protected $primaryKey='id';
	protected $with=array('persona','lider');
	protected $guarded = array();
	public static $rules = array();

	public function Persona(){
		return $this->belongsTo('App\models\Personas','id_persona','id');
	}

	public function Lider(){
		return $this->belongsTo('App\models\Lideres','id_lider','id');
	}

	
}
