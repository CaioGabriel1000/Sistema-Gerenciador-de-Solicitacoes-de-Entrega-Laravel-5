<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntregaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entrega', function(Blueprint $table)
		{
			$table->foreign('codigoPedido', 'FK_Entrega_1')->references('codigoPedido')->on('pedido')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('codigoEndereco', 'FK_Entrega_2')->references('codigoEndereco')->on('endereco')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('codigoEntregador', 'FK_Entrega_3')->references('codigoEntregador')->on('entregador')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entrega', function(Blueprint $table)
		{
			$table->dropForeign('FK_Entrega_1');
			$table->dropForeign('FK_Entrega_2');
			$table->dropForeign('FK_Entrega_3');
		});
	}

}
