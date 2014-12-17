<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precios', function(Blueprint $table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->string('tratamientos_id');
			$table->string('companias_id');
			$table->float('precio');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('precios', function(Blueprint $table)
		{
			//
		});
	}

}
