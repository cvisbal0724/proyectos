<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Alcaldes extends Model {

	protected $table = 'alcaldes';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
