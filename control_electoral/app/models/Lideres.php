<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lideres extends Model {

	protected $table = 'lideres';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
