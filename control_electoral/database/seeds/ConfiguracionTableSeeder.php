<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Alcaldes;
use App\models\Partidos;
use App\models\Perfiles;
use App\models\Usuarios;
use App\models\Personas;
use \Illuminate\Support\Facades\DB;

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

        $perfiles=['Administrador','Alcalde','Concejales','Lider'];

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

		Usuarios::create(array(

			'usuario'=>'cvisbal',
			'password'=>Hash::make('12345'),
			'id_persona'=>$per['id'],
			'id_perfil'=>1

		));

		      
       
    }
}