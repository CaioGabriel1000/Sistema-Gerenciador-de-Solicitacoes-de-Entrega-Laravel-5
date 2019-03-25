<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefoneFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefone_funcionario', function(Blueprint $table)
		{
			$table->foreign('codigoFuncionario', 'FK_telefone_funcionario_1')->references('codigoFuncionario')->on('funcionario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefone_funcionario', function(Blueprint $table)
		{
			$table->dropForeign('FK_telefone_funcionario_1');
		});
	}

}
