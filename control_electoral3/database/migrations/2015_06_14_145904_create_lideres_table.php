<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLideresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lideres', function(Blueprint $table)
		{	
			$table->increments('id');
			$table->integer('id_persona')->unsigned();
			$table->integer('id_encargado')->unsigned();
			$table->string('foto');
			$table->foreign('id_persona')->references('id')->on('personas');
			$table->foreign('id_encargado')->references('id')->on('usuarios');
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
		Schema::drop('lideres');
	}

}
