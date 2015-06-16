<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pacientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('votes')->nullable();
			$table->char('numerohistoria')->nullable();
			$table->char('apellido1',50)->nullable();
			$table->char('apellido2',50)->nullable();
			$table->char('nombre',50)->nullable();
			$table->char('NIF',50)->nullable();
			$table->date('fechanacimiento')->nullable();
			$table->char('sexo',10)->nullable();
			$table->char('Direccion',50)->nullable();
			$table->char('addrnamestre',50)->nullable();
			$table->char('addrtel1',50)->nullable();
			$table->char('addrtel2',50)->nullable();
			$table->char('terrdesc',50)->nullable();
			$table->char('addrpostcode',50)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pacientes');
	}

}
