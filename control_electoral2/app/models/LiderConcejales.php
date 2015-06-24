<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LiderConcejales extends Model {

	protected $table = 'lider_concejales';
	protected $primaryKey=array('id_lider','id_concejal');
	protected $guarded = array();
	public static $rules = array();
	protected $with=array('concejal','lider');
	public $timestamps = false;
	
	public function Concejal(){
		return $this->belongsTo('App\models\Concejales','id_concejal','id');
	}

	public function Lider(){
		return $this->belongsTo('App\models\Lideres','id_lider','id');
	}

}
