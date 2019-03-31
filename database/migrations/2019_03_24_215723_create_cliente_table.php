<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->integer('codigoCliente',true);
            $table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->bigInteger('telefone');
			$table->char('situacao', 1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente');
	}

}
