<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LiderConcejales extends Model {

	protected $table = 'lider_concejal';
	protected $primaryKey=array('id_lider','id_concejal');
	protected $guarded = array();
	public static $rules = array();

}
