<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('turnos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->date('fecha_turno');
                        $table->integer('profesional_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('turnos', function(Blueprint $table)
		{
			Schema::drop('turnos');
		});
	}

}
