<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntregadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entregador', function(Blueprint $table)
		{
			$table->integer('codigoEntregador', true);
			$table->string('nome');
			$table->integer('inicioJornadaTrabalho');
			$table->integer('fimJornadaTrabalho');
			$table->integer('codigoEstabelecimento')->nullable()->default(1)->index('FK_Entregador_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entregador');
	}

}
