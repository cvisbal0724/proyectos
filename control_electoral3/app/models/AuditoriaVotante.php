<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AuditoriaVotante extends Model {
	
	protected $table = 'auditoria_votantes';
	protected $primaryKey='id';
	protected $guarded = array();
	public static $rules = array();

}
