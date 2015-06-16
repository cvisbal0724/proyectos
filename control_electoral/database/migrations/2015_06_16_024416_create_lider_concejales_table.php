<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiderConcejalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lider_concejales', function(Blueprint $table)
		{						
			$table->integer('meta');
			$table->integer('id_lider')->unsigned();
			$table->integer('id_concejal')->unsigned();		
			$table->foreign('id_lider')->references('id')->on('lideres');
			$table->foreign('id_concejal')->references('id')->on('concejales');	
			$table->primary(array('id_lider','id_concejal'));
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
		Schema::drop('lider_concejales');
	}

}
