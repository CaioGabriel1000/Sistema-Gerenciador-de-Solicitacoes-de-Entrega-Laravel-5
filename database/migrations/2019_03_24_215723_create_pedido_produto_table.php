<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido_produto', function(Blueprint $table)
		{
			$table->integer('codigoProduto')->index('FK_pedido_produto_1');
			$table->integer('codigoPedido')->index('FK_pedido_produto_2');
			$table->integer('quantidade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedido_produto');
	}

}
