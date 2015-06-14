<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('usuario')->unique();				
			$table->string('password',60);	
			$table->integer('id_persona')->unsigned();
			$table->integer('id_perfil')->unsigned();
			$table->integer('id_entidad')->unsigned();
			$table->integer('id_oficio');
			$table->boolean('bloqueado');
			$table->foreign('id_persona')->references('id')->on('personas');
			$table->foreign('id_perfil')->references('id')->on('perfiles');	
			$table->rememberToken();
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
		Schema::drop('usuarios');
	}

}
