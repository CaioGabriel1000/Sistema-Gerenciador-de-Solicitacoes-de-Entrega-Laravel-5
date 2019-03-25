<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefoneEstabelecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefone_estabelecimento', function(Blueprint $table)
		{
			$table->bigInteger('telefoneEstabelecimento');
			$table->integer('codigoEstabelecimento')->index('FK_telefone_estabelecimento_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefone_estabelecimento');
	}

}
