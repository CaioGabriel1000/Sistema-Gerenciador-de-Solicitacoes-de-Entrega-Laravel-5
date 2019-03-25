<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto', function(Blueprint $table)
		{
			$table->integer('codigoProduto', true);
			$table->string('nome', 45);
			$table->string('descricao')->nullable();
			$table->string('sku', 10)->nullable();
			$table->float('valorUnitario', 10, 0);
			$table->integer('quantidadeEstoque')->default(1);
			$table->integer('codigoCategoria')->nullable()->index('FK_Produto_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produto');
	}

}
