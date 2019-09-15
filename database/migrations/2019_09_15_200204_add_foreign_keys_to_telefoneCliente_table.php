<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefoneClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefoneCliente', function(Blueprint $table)
		{
			$table->foreign('codigoCliente', 'FK_telefoneCliente_1')->references('codigoCliente')->on('cliente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefoneCliente', function(Blueprint $table)
		{
			$table->dropForeign('FK_telefoneCliente_1');
		});
	}

}
