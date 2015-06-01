<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplanteoAtributos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			$table->dropTimestamps();
			$table->char('tipo_turno', 1)->after('fecha_turno');
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
