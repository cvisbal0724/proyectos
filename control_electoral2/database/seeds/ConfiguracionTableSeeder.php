<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Alcaldes;
use App\models\Partidos;
use App\models\Perfiles;
use App\models\Usuarios;
use App\models\Personas;
use App\models\Entidades;
use \Illuminate\Support\Facades\DB;
use App\models\TipoVoto;
use App\models\LugaresDeVotacion;
use App\models\CategoriaVotacion;

class ConfiguracionTableSeeder extends Seeder
{
	
    public function run()
    {
    	
		DB::table('partidos')->delete();
       
       $par=Partidos::create(array(
        	'nombre'=>'U'
        ));

       $alc=Alcaldes::create(array(
        	'nombre'=>'Geovany Vergara',
        	'id_partido'=>$par['id'],
        	'numero'=>1        	
        ));

        $perfiles=['Administrador','Alcalde','Concejal','Lider'];

		foreach ($perfiles as $key => $value) {
			 Perfiles::create(array(
		        	'nombre'=>$value
		      ));
		}
		
		$per=Personas::create(array(
			'cedula'=>'1044422259',
			'nombre'=>'Carlos',
			'apellido'=>'Visbal',
			'telefono'=>'3014647797',
			'direccion'=>'Calle 10',
			'id_alcalde'=>$alc['id'],
		));

		$entidades[]=array('id'=>1,'nombre'=>'Alcalde');
		$entidades[]=array('id'=>2,'nombre'=>'Concejal');
		$entidades[]=array('id'=>3,'nombre'=>'Lider');

		Entidades::insert($entidades);

		Usuarios::create(array(

			'usuario'=>'cvisbal',
			'password'=>Hash::make('12345'),
			'id_persona'=>$per['id'],
			'id_perfil'=>1

		));

		$tipoVoto=[array('nombre'=>'Confianza'),array('nombre'=>'Otro')];
		TipoVoto::insert($tipoVoto);

		$lugaresVotacion=[
		array('nombre'=>'Francisco J. Cisneros'),
		array('nombre'=>'Maria Mancilla Sanchez'),
		array('nombre'=>'Simon Bolivar')];

		LugaresDeVotacion::insert($lugaresVotacion);

		$categoriaVotacion=[
		array('nombre'=>'Concejo'),
		array('nombre'=>'Alcaldia'),
		array('nombre'=>'Concejo y Alcaldia')];

		CategoriaVotacion::insert($categoriaVotacion);
		      
       
    }
}
