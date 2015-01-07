<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->string('especialidad');
                        $table->string('codigo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('especialidades');
	}

}
