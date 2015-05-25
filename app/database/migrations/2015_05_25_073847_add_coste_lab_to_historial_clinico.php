<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCosteLabToHistorialClinico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historial_clinico', function(Blueprint $table)
		{
			$table->float('coste_lab')->nullable();
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
