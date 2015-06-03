<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PersonaTableSeeder extends Seeder
{
    public function run()
    {
        Personas::create(array(
			'cedula'=>'1044422259',
			'nombre'=>'Carlos',
			'apellido'=>'Visbal',
			'telefono'=>'3014647797',
			'direccion'=>'Calle 10',
			'id_alcalde'=>1
		));
    }
}
