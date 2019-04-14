<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBairroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bairro', function(Blueprint $table)
		{
			$table->foreign('codigoCidade', 'FK_Bairro_1')->references('codigoCidade')->on('cidade')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bairro', function(Blueprint $table)
		{
			$table->dropForeign('FK_Bairro_1');
		});
	}

}
