<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcaldesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alcaldes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre',120);
			$table->integer('id_partido')->unsigned();
			$table->foreign('id_partido')->references('id')->on('partidos');
			$table->integer('numero');
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
		Schema::drop('alcaldes');
	}

}
