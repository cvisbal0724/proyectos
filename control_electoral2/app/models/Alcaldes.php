<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Alcaldes extends Model {

	protected $table = 'alcaldes';
	protected $primaryKey='id';
	protected $with =array('partido');
	protected $guarded = array();
	public static $rules = array();

	public function Partido(){
		return $this->belongsTo('App\models\Partidos','id_partido','id');
	}

}
