<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCosteLabToPresupuestos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos', function(Blueprint $table)
		{
			$table->float('coste_lab');
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
			//
		});
	}

}
