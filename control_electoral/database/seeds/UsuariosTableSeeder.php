<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use DB;

class UsuariosTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
         DB::table('usuarios')->insert(
	       	array(
		       	'id_perfil'=>1,
		       	'id_persona'=>1,
		       	'password'=>Hash::make('12345'),
		       	'usuario'=>'cvisbal',
	       )
       );
    }
}
