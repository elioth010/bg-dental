<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesProfesionalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sedes_profesionales', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('sede_id');
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
		Schema::table('sedes_profesionales', function(Blueprint $table)
		{
			//
		});
	}

}
