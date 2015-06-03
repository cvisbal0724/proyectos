<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Concejales extends Model {

	protected $table = 'concejales';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
