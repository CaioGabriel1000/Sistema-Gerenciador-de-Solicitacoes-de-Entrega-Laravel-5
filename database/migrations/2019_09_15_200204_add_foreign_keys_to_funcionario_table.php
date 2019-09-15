<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario', function(Blueprint $table)
		{
			$table->foreign('codigoEstabelecimento', 'FK_Funcionario_1')->references('codigoEstabelecimento')->on('estabelecimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario', function(Blueprint $table)
		{
			$table->dropForeign('FK_Funcionario_1');
		});
	}

}
