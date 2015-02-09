<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TratamientoPiezas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table)
		{
            $table->dropColumn('pieza1');
            $table->dropColumn('pieza2');
            $table->dropColumn('pieza3');
            $table->string('piezas', 20)->nullable();
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
