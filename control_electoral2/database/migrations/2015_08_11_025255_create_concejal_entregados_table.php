<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcejalEntregadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('concejal_entregado', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_concejal')->unsigned();
			$table->integer('id_usuario')->unsigned();
			$table->text('observacion');
			$table->integer('valor');
			$table->foreign('id_concejal')->references('id')->on('concejales');
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
		Schema::drop('concejal_entregado');
	}

}
