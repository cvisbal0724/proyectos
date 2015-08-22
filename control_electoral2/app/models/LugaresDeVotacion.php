<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LugaresDeVotacion extends Model {

	protected $table = 'lugares_de_votacion';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();
	protected $with=array('zona');

	public function Zona(){
		return $this->belongsTo('App\models\Zonas','id_zona','id');
	}

}
