<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cobros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('paciente_id');
                        $table->float('cobro');
                        $table->integer('tipos_de_cobro_id');
		});
                
                Schema::create('tipos_de_cobro', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('nombre');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cobros', function(Blueprint $table)
		{
			//
		});
	}

}
