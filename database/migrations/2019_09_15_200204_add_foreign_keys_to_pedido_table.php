<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedido', function(Blueprint $table)
		{
			$table->foreign('codigoCliente', 'FK_Pedido_1')->references('codigoCliente')->on('cliente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('codigoFuncionario', 'FK_Pedido_2')->references('codigoFuncionario')->on('funcionario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedido', function(Blueprint $table)
		{
			$table->dropForeign('FK_Pedido_1');
			$table->dropForeign('FK_Pedido_2');
		});
	}

}
