<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiderEntregadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lider_entregado', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_lider')->unsigned();
			$table->integer('id_usuario')->unsigned();
			$table->text('observacion');
			$table->integer('valor');
			$table->foreign('id_lider')->references('id')->on('lideres');
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
		Schema::drop('lider_entregado');
	}

}
