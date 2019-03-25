<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstabelecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estabelecimento', function(Blueprint $table)
		{
			$table->integer('codigoEstabelecimento')->default(1)->primary();
			$table->string('razaoSocial')->nullable();
			$table->string('nomeFantasia', 45);
			$table->bigInteger('cnpj')->nullable();
			$table->integer('inicioJornadaFuncionamento');
			$table->integer('fimJornadaFuncionamento');
			$table->integer('diasFuncionamento');
			$table->char('identidadeVisual', 1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estabelecimento');
	}

}
