<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntregaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entrega', function(Blueprint $table)
		{
			$table->integer('codigoEntrega', true);
			$table->char('situacao', 1)->nullable();
			$table->integer('codigoPedido')->nullable()->index('FK_Entrega_1');
			$table->integer('codigoEndereco')->nullable()->index('FK_Entrega_2');
			$table->integer('codigoEntregador')->nullable()->index('FK_Entrega_3');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entrega');
	}

}
