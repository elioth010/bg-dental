<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GuardarCompaniaPresupuesto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
			$table->integer('compania_id');
		});

		Schema::table('pacientes', function(Blueprint $table)
		{
			$table->dropColumn('compania');
			$table->dropColumn('compania2');
		});

		Schema::table('pacientes', function(Blueprint $table)
		{
			$table->integer('compania');
			$table->integer('compania2');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
			//
		});
	}

}
