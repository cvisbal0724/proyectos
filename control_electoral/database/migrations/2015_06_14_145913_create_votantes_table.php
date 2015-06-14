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
			$table->integer('id_entidad')->unsigned();
			$table->integer('id_encargado')->unsigned();
			$table->integer('id_concejal')->unsigned();
			$table->boolean('voto');
			$table->integer('id_tipo_voto')->unsigned();
			$table->integer('id_categoria_votacion')->unsigned();
			$table->text('comentario');
			$table->integer('id_lugar_de_votacion')->unsigned();
			$table->integer('numero_mesa');
			$table->foreign('id_persona')->references('id')->on('personas');
			$table->foreign('id_entidad')->references('id')->on('entidades');
			$table->foreign('id_concejal')->references('id')->on('concejales');
			$table->foreign('id_tipo_voto')->references('id')->on('tipo_voto');
			$table->foreign('id_lugar_de_votacion')->references('id')->on('lugares_de_votacion');
			$table->foreign('id_categoria_votacion')->references('id')->on('categoria_votacion');
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
