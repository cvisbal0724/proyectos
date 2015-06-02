<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_persona')->unsigned();
			$table->integer('id_lider')->unsigned();
			$table->integer('id_concejal')->unsigned();
			$table->foreign('id_persona')->references('id')->on('personas');
			$table->foreign('id_lider')->references('id')->on('lideres');
			$table->foreign('id_concejal')->references('id')->on('concejales');
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
		Schema::drop('votantes');
	}

}
