<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemporalCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('temporal_compra', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('ID_PRODUCTO_PROVEEDOR')->unsigned();
			$table->foreign('ID_PRODUCTO_PROVEEDOR')->references('ID')->on('productos_proveedor');
			$table->integer('CANTIDAD');
			$table->integer('ID_USUARIO')->unsigned();
			$table->foreign('ID_USUARIO')->references('ID')->on('usuario');		
			$table->timestamps();
			
		});*/
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('temporal_compra');
	}

}
