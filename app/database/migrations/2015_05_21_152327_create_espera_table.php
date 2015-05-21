<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsperaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('espera', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('paciente_id');
                        $table->integer('admitido')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('espera', function(Blueprint $table)
		{
			//
		});
	}

}
