<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefoneFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefone_funcionario', function(Blueprint $table)
		{
			$table->bigInteger('telefoneFuncionario')->nullable();
			$table->integer('codigoFuncionario')->index('FK_telefone_funcionario_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefone_funcionario');
	}

}
