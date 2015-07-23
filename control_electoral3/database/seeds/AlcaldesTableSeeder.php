<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Alcaldes;
use \Illuminate\Support\Facades\DB;

class AlcaldesTableSeeder extends Seeder
{
    public function run()
    {
              
        Alcaldes::create(array(
        	'nombre'=>'Geovany Vergara',
        	'id_partido'=>1,
        	'numero'=>1        	
        ));
    }
}
