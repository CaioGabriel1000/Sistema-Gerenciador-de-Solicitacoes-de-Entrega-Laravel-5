<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamento', function(Blueprint $table)
		{
			$table->foreign('codigoPedido', 'FK_Pagamento_1')->references('codigoPedido')->on('pedido')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamento', function(Blueprint $table)
		{
			$table->dropForeign('FK_Pagamento_1');
		});
	}

}
