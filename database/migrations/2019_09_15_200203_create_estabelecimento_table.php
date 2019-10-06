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
			$table->integer('codigoEstabelecimento', true);
			$table->string('razaoSocial', 100)->nullable();
			$table->string('nomeFantasia', 45)->nullable();
			$table->bigInteger('cnpj')->nullable();
			$table->integer('inicioJornadaFuncionamento')->nullable();
			$table->integer('fimJornadaFuncionamento')->nullable();
			$table->integer('diasFuncionamento')->nullable();
			$table->char('identidadeVisual', 1)->nullable();
		});

		// Inserindo estabelecimento padrão
		DB::table('estabelecimento')->insert(
			array(
				'razaoSocial' => 'SGSE',
				'nomeFantasia' => 'SGSE',
				'cnpj' => 12345678901234,
				'inicioJornadaFuncionamento' => 0,
				'fimJornadaFuncionamento' => 1440,
				'diasFuncionamento' => 127,
				'identidadeVisual' => 'G'
			)
		);
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
