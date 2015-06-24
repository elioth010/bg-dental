<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnidadesToHistorialClinico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historial_clinico', function(Blueprint $table)
		{
			$table->integer('unidades')->default(1)->after('precio');
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
