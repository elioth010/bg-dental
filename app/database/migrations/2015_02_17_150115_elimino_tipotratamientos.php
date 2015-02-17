<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminoTipotratamientos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
            $table->dropColumn('tipostratamientos_id');
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
