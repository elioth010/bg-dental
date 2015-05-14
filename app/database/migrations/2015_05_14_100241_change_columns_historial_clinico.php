<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsHistorialClinico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
			DB::raw("ALTER TABLE `beta_bg_dental`.`historial_clinico` 
CHANGE COLUMN `cobrado_paciente` `cobrado_paciente` INT(11) NULL ,
CHANGE COLUMN `abonado_quiron` `abonado_quiron` DOUBLE NULL ,
CHANGE COLUMN `cobrado_profesional` `cobrado_profesional` DOUBLE NULL;");

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
