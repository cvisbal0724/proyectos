<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LiderEntregado extends Model {

	protected $table = 'lider_entregado';
	protected $primaryKey='id';
	protected $with=array('lider');
	protected $guarded = array();
	public static $rules = array();

	public function Lider(){
		return $this->belongsTo('App\models\Lideres','id_lider','id');
	}

}
