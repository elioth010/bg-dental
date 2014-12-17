<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupostratamientosTratamientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupostratamientos_tratamientos', function(Blueprint $table)
		{
		$table->timestamps();
		$table->increments('id');
		$table->integer('tratamientos_id');
		$table->integer('grupotratamientos_id');
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
