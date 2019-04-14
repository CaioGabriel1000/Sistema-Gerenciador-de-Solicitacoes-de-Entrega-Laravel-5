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
		Schema::create('telefoneEstabelecimento', function(Blueprint $table)
		{
			$table->bigInteger('telefoneEstabelecimento');
			$table->integer('codigoEstabelecimento')->nullable()->index('FK_telefoneEstabelecimento_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefoneEstabelecimento');
	}

}
