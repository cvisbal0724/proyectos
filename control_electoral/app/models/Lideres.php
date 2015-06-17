<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lideres extends Model {

	protected $table = 'lideres';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();
	protected $with=array('persona');
	
	public function Persona(){
		return $this->belongsTo('App\models\Personas','id_persona','id');
	}

}
