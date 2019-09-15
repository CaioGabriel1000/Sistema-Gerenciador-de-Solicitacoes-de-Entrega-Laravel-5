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
		Schema::table('telefoneEstabelecimento', function(Blueprint $table)
		{
			$table->foreign('codigoEstabelecimento', 'FK_telefoneEstabelecimento_1')->references('codigoEstabelecimento')->on('estabelecimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefoneEstabelecimento', function(Blueprint $table)
		{
			$table->dropForeign('FK_telefoneEstabelecimento_1');
		});
	}

}
