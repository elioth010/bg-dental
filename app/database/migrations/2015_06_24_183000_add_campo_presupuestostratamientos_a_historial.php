<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampoPresupuestostratamientosAHistorial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historial_clinico', function(Blueprint $table)
		{
			$table->integer('presupuesto_tratamiento_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('historial_clinico', function(Blueprint $table)
		{
			//
		});
	}

}
