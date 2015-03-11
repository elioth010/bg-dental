<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdsEnteros extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
			$table->dropColumn('presupuesto_id');
			$table->dropColumn('tratamiento_id');
		});

		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
			$table->integer('presupuesto_id')->after('id');
			$table->integer('tratamiento_id')->after('presupuesto_id');
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
