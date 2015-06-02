<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre',100);
			$table->string('etiqueta',100);
			$table->integer('id_padre');
			$table->integer('id_modulo')->unsigned();
			$table->foreign('id_modulo')->references('id')->on('modulos');
			$table->string('url',150);
			$table->integer('orden');
			$table->string('imagen',200);
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
		Schema::drop('menus');
	}

}
