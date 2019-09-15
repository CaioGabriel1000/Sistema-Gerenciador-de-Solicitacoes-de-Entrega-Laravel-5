<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBairroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bairro', function(Blueprint $table)
		{
			$table->integer('codigoBairro', true);
			$table->string('nome', 45)->nullable();
			$table->float('valorFrete', 10, 0)->nullable();
			$table->integer('codigoCidade')->nullable()->index('FK_Bairro_1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bairro');
	}

}
