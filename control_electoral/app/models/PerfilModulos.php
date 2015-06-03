<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PerfilModulos extends Model {

	protected $table = 'perfil_modulos';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
