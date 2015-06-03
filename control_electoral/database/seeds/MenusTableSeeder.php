<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\models\Menus;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        $lista=['Partidos','Alcaldes','Personas','Perfiles','Modulos','Menus','Usuarios','Concejales','Lideres','Votantes'];

        foreach ($lista as $key => $value) {
        	$rs=Menus::create(array(
        		'nombre'=>$value,
        		'etiqueta'=>$value,
        		'id_padre'=>0,
        		'id_modulo'=>$key+1,
        		'url'=>'',
        		'orden'=>$key+1,
        		'imagen'=>'fa fa-wrench'
        	));

        	Menus::create(array(
        		'nombre'=>'Registrar',
        		'etiqueta'=>'Registrar',
        		'id_padre'=>$rs['id'],
        		'id_modulo'=>$key+1,
        		'url'=>'',
        		'orden'=>1,
        		'imagen'=>'fa fa-arrow-circle-o-right'
        	));

        	Menus::create(array(
        		'nombre'=>'Consultar',
        		'etiqueta'=>'Consultar',
        		'id_padre'=>$rs['id'],
        		'id_modulo'=>$key+1,
        		'url'=>'',
        		'orden'=>2,
        		'imagen'=>'fa fa-search'
        	));
        }
    }
}
