<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Entidades extends Model {

	protected $table = 'entidades';
	protected $primaryKey='id';
	//protected $with=array('partido','persona');
	protected $guarded = array();
	public static $rules = array();
}

