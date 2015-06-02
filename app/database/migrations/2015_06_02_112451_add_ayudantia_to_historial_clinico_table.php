<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAyudantiaToHistorialClinicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historial_clinico', function(Blueprint $table)
		{
			$table->integer('ayudantia')->default(0);
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
