<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ConcejalEntregado extends Model {

	protected $table = 'concejal_entregado';
	protected $primaryKey='id';
	protected $with=array('concejal');
	protected $guarded = array();
	public static $rules = array();

	public function Concejal(){
		return $this->belongsTo('App\models\Concejales','id_concejal','id');
	}

}
