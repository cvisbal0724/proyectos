<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcejalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('concejales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_persona')->unsigned();
			$table->integer('id_usuario')->unsigned();
			$table->integer('numero');
			$table->foreign('id_persona')->references('id')->on('personas');
			$table->foreign('id_usuario')->references('id')->on('usuarios');
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
		Schema::drop('concejales');
	}

}
