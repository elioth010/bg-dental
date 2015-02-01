<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PresupuestosDescuento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('presupuestos', function(Blueprint $table) {
            $table->double('descuento');
            $table->char('tipodescuento', 1)->default('E');
        });

        Schema::table('presupuestos_tratamientos', function(Blueprint $table) {
            $table->renameColumn('desc_euros', 'descuento');
            $table->dropColumn('desc_porcien');
            $table->char('tipodescuento', 1)->default('E');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
