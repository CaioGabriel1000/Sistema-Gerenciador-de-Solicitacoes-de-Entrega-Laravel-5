<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefoneEntregadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefone_entregador', function(Blueprint $table)
		{
			$table->foreign('codigoEntregador', 'FK_telefone_entregador_1')->references('codigoEntregador')->on('entregador')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefone_entregador', function(Blueprint $table)
		{
			$table->dropForeign('FK_telefone_entregador_1');
		});
	}

}
