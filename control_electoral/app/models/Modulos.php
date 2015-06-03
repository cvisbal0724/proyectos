<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model {

	protected $table = 'modulos';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
