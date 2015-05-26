<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiarColumnaFechaRealizacionADateHistorialClinico2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::raw("ALTER TABLE `historial_clinico` CHANGE COLUMN `fecha_realizacion` `fecha_realizacion` DATE NOT NULL;");
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
