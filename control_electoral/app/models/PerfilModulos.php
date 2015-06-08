<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PerfilModulos extends Model {

	protected $table = 'perfil_modulos';
	protected $primaryKey='id';
	protected $with=array('modulo','perfil');
	protected $guarded = array();
	public static $rules = array();

	public function Modulo(){
		return $this->belongsTo('App\models\Modulos','id_modulo','id');
	}

	public function Perfil(){
		return $this->belongsTo('App\models\Perfiles','id_perfil','id');
	}
}
