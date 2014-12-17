<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposToPresupuestosTratamientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('presupuestos_tratamientos', function(Blueprint $table) {
		$table->integer('tipostratamientos_id');
		$table->integer('unidades');
		$table->double('desc_euros');
		$table->double('desc_porcien');
		$table->integer('pieza1');
		$table->integer('pieza2');
		$table->integer('pieza3');
		$table->integer('estado');
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
