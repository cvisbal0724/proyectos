<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcepcionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('excepciones', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->string('excepcion');
			$table->integer('id_usuario');
			$table->string('controlador');
			$table->string('metodo');
			$table->string('mensaje');
			$table->string('enviado');
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
		Schema::drop('excepciones');
	}

}
