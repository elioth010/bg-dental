<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntradaYSalidaEspera extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('espera', function(Blueprint $table)
		{
			$table->dateTime('end_date')->after('created_at');
			$table->renameColumn('created_at', 'begin_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('espera', function(Blueprint $table)
		{
			//
		});
	}

}
