<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PerfilesTableSeeder extends Seeder
{
    public function run()
    {
        $perfiles=['Administrador','Alcalde','Concejales','Lider'];

		foreach ($perfiles as $key => $value) {
			 Perfiles::create(array(
		        	'nombre'=>$value
		      ));
		}
    }
}
