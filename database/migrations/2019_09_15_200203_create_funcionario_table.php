<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario', function(Blueprint $table)
		{
			$table->integer('codigoFuncionario', true);
			$table->string('name')->nullable();
			$table->string('email')->nullable()->unique('email');
			$table->string('password')->nullable();
			$table->boolean('administrador')->nullable();
			$table->char('situacao', 1)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->integer('codigoEstabelecimento')->nullable()->index('FK_Funcionario_1');
			$table->timestamps();
		});

		// Inserindo funcionario padrão
		// Senha padrão utilizando o .env padrão = "you shall not pass"
		DB::table('funcionario')->insert(
			array(
				'name' => 'SGSE',
				'email' => 'sgse@email.com',
				'password' => '$2y$10$UhUkjCc3qHmZgTc7mlFjf./JQBZvT5dfTdfzjginynEMwatz/7CgG',
				'administrador' => 1,
				'situacao' => 'A',
				'remember_token' => NULL,
				'codigoEstabelecimento' => 1,
				'created_at' => NULL,
				'updated_at' => NULL
			)
		);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario');
	}

}
