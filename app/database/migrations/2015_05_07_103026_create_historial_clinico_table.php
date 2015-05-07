<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialClinicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historial_clinico', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('paciente_id');
			$table->integer('profesional_id');
                        $table->integer('tratamiento_id');
                        $table->datetime('fecha_realizacion');
                        $table->integer('cobrado_paciente');
                        $table->integer('abonado_quiron');// abonado por Quirón
                        $table->integer('cobrado_profesional');//cobrado por profesional
                        
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
			Schema::drop('historial_clinico');
		});
	}

}
