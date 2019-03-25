<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefoneEntregadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefone_entregador', function(Blueprint $table)
		{
			$table->bigInteger('telefoneEntregador');
			$table->integer('codigoEntregador')->index('FK_telefone_entregador_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefone_entregador');
	}

}
