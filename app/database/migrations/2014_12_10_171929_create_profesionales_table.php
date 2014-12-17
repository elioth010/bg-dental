<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profesionales', function(Blueprint $table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->string('nombre');
			$table->string('apellido1');
			$table->string('apellido2');
			$table->integer('especialidad');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profesionales', function(Blueprint $table)
		{
			//
		});
	}

}
