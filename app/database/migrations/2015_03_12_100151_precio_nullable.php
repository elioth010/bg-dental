<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrecioNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `precios` CHANGE `precio` `precio` FLOAT( 8, 2 ) NULL");
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
			DB::statement("ALTER TABLE `precios` CHANGE `precio` `precio` FLOAT( 8, 2 ) NOT NULL");
		});
	}

}
