<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TipoVoto extends Model {

	protected $table = 'tipo_voto';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
