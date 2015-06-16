<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVotacion extends Model {

	protected $table = 'categoria_votacion';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
