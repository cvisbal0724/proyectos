<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Zonas extends Model {

	protected $table = 'zonas';
	protected $primaryKey='id';
	protected $with=array();
	protected $guarded = array();
	public static $rules = array();

}
