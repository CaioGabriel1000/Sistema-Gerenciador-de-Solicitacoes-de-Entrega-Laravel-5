<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefoneEstabelecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefone_estabelecimento', function(Blueprint $table)
		{
			$table->foreign('codigoEstabelecimento', 'FK_telefone_estabelecimento_1')->references('codigoEstabelecimento')->on('estabelecimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefone_estabelecimento', function(Blueprint $table)
		{
			$table->dropForeign('FK_telefone_estabelecimento_1');
		});
	}

}
