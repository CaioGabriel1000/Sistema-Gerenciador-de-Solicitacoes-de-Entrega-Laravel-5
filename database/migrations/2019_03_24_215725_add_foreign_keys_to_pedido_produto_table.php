<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidoProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedido_produto', function(Blueprint $table)
		{
			$table->foreign('codigoProduto', 'FK_pedido_produto_1')->references('codigoProduto')->on('produto')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('codigoPedido', 'FK_pedido_produto_2')->references('codigoPedido')->on('pedido')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedido_produto', function(Blueprint $table)
		{
			$table->dropForeign('FK_pedido_produto_1');
			$table->dropForeign('FK_pedido_produto_2');
		});
	}

}
