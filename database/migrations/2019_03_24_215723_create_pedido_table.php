<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido', function(Blueprint $table)
		{
			$table->integer('codigoPedido', true);
			$table->float('valorTotal', 10, 0);
			$table->char('formaPagamento', 1);
			$table->string('observacoes', 45)->nullable();
			$table->char('situacao', 1);
			$table->timestamp('criacao')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('atualizacao')->nullable();
			$table->integer('codigoCliente')->index('FK_Pedido_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedido');
	}

}
