<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToCobrosHistorialClinicoId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cobros', function(Blueprint $table)
		{
			$table->integer('historial_clinico_id');
		});
                
                Schema::table('historial_clinico', function(Blueprint $table)
		{
			$table->dropColumn('cobros_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cobros', function(Blueprint $table)
		{
			//
		});
	}

}
