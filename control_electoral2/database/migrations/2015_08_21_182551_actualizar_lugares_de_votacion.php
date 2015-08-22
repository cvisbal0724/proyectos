<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActualizarLugaresDeVotacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lugares_de_votacion', function($table)
		{
		    $table->integer('id_zona')->nullable();
		    //$table->foreign('id_zona')->references('id')->on('zonas');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lugares_de_votacion', function($table)
		{
		    $table->dropColumn('id_zona');
		});
	}

}
