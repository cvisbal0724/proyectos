<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model {

	protected $table = 'perfiles';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
