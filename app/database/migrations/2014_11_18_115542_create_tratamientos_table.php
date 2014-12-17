<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratamientos', function(Blueprint $table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->string('codigo');
			$table->string('nombre');
			$table->float('precio_base');
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratamientos', function(Blueprint $table)
		{
			//
		});
	}

}
