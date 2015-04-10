<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PresupuestosCampoObservaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos', function(Blueprint $table)
		{
			$table->longText('observaciones')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('presupuestos', function(Blueprint $table)
		{
			$table->dropColumn('observaciones');
		});
	}

}
