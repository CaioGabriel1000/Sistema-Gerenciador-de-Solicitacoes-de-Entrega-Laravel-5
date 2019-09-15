<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntregadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entregador', function(Blueprint $table)
		{
			$table->foreign('codigoEstabelecimento', 'FK_Entregador_1')->references('codigoEstabelecimento')->on('estabelecimento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entregador', function(Blueprint $table)
		{
			$table->dropForeign('FK_Entregador_1');
		});
	}

}
