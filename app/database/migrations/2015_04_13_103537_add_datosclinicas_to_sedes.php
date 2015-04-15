<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatosclinicasToSedes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sedes', function(Blueprint $table)
		{
			$table->string('calleynum');
                        $table->string('cp');
                        $table->string('ciudad');
                        $table->string('provincia');
                        $table->string('tel');
                        $table->string('mail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sedes', function(Blueprint $table)
		{
			//
		});
	}

}
