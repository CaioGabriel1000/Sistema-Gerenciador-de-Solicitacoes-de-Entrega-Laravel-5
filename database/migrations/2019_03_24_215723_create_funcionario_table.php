<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario', function(Blueprint $table)
		{
			$table->integer('codigoFuncionario', true);
			$table->string('nome');
			$table->string('email')->unique('email');
			$table->string('senha');
			$table->string('remember_token', 100)->nullable();
			$table->boolean('administrador');
			$table->dateTime('criacao')->nullable();
			$table->dateTime('atualizacao')->nullable();
			$table->integer('codigoEstabelecimento')->nullable()->default(1)->index('FK_Funcionario_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario');
	}

}
