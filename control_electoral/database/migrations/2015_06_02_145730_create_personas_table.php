<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cedula');
			$table->string('nombre',120);
			$table->string('apellido',120);
			$table->string('telefono',100);
			$table->string('direccion',100);
			$table->integer('id_alcalde')->unsigned();
			$table->foreign('id_alcalde')->references('id')->on('alcaldes');
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
		Schema::drop('personas');
	}

}
