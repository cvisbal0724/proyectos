<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model {

	protected $table = 'personas';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
