<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfil_modulos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_perfil')->unsigned();			
			$table->integer('id_modulo')->unsigned();
			$table->foreign('id_perfil')->references('id')->on('perfiles');
			$table->foreign('id_modulo')->references('id')->on('modulos');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perfil_modulos');
	}

}
