<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Modulos;

class ModulosTableSeeder extends Seeder
{
    public function run()
    {
    	$lista=['Partidos','Alcaldes','Personas','Perfiles','Modulos','Menus','Usuarios','Concejales','Lideres','Votantes'];

    	foreach ($lista as $key => $value) {
    		 Modulos::create(array(

        		'nombre'=>$value

        	));
    	}

       
    }
}
