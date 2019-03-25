<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente', function(Blueprint $table)
		{
			$table->integer('codigoCliente', true);
			$table->string('nome');
			$table->string('email')->unique('email');
			$table->string('senha');
			$table->char('situacao', 1);
			$table->bigInteger('telefone');
			$table->string('remember_token', 100)->nullable();
			$table->dateTime('criacao')->nullable();
			$table->dateTime('atualizacao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente');
	}

}
