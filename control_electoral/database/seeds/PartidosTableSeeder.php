<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Partidos;
use \Illuminate\Support\Facades\DB;

class PartidosTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        DB::table('partidos')->delete();
       
        Partidos::create(array(
        	'nombre'=>'U'
        ));
    }
}
