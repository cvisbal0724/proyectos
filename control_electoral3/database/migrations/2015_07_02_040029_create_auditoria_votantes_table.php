<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriaVotantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auditoria_votantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_votante')->unsigned();
			$table->integer('id_usuario')->unsigned();
			$table->string('observacion',500);
			$table->foreign('id_votante')->references('id')->on('votantes');
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
		Schema::drop('auditoria_votantes');
	}

}
