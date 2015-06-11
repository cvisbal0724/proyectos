<?php

/*use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;*/

class Usuario extends Eloquent{// implements UserInterface, RemindableInterface

	//use UserTrait, RemindableTrait;
	protected $table = 'usuario';	
	protected $fillable = array('USUARIO','ID_PERSONA','ID_PERFIL');
	protected $primaryKey='ID';
	protected $with = array('Perfil', 'Persona');
	protected $hidden = array('CLAVE');//,'remember_token'	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;



	public function Perfil(){
		return $this->belongsTo('Perfil','ID_PERFIL', 'ID');
	}

	public function Persona(){
		return $this->belongsTo('Persona','ID_PERSONA','ID');
	}

	public function Nombre_Completo(){
		return $this->Persona->NOMBRES . ' ' . $this->Persona->APELLIDOS;
	}

}