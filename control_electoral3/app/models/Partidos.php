<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Partidos extends Model {

	protected $table = 'partidos';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
