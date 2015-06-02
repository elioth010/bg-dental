<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoTurnoChar2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			//
			$table->dropColumn('tipo_turno');

		});

		Schema::table('turnos', function(Blueprint $table)
		{
			//
			$table->char('tipo_turno', 2)->after('fecha_turno');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			//
		});
	}

}
