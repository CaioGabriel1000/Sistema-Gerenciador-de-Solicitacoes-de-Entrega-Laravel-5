<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cidade', function(Blueprint $table)
		{
			$table->integer('codigoCidade', true);
			$table->string('nome', 45)->nullable();
			$table->char('estado', 2)->nullable();
			$table->float('valorFrete', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cidade');
	}

}
