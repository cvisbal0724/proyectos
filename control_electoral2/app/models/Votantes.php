<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Votantes extends Model {

	protected $table = 'votantes';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
