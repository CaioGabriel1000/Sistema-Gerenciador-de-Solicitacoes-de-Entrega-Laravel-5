<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produto', function(Blueprint $table)
		{
			$table->foreign('codigoCategoria', 'FK_Produto_1')->references('codigoCategoria')->on('categoria')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produto', function(Blueprint $table)
		{
			$table->dropForeign('FK_Produto_1');
		});
	}

}
