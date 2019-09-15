<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefoneClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefoneCliente', function(Blueprint $table)
		{
			$table->bigInteger('telefoneCliente');
			$table->integer('codigoCliente')->nullable()->index('FK_telefoneCliente_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefoneCliente');
	}

}
