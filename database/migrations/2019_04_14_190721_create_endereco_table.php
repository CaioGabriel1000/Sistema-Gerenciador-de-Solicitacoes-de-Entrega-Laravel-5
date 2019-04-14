<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco', function(Blueprint $table)
		{
			$table->integer('codigoEndereco', true);
			$table->string('logradouro', 100)->nullable();
			$table->string('numero', 10)->nullable();
			$table->string('complemento', 50)->nullable();
			$table->integer('cep')->nullable();
			$table->integer('codigoBairro')->nullable()->index('FK_Endereco_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('endereco');
	}

}
