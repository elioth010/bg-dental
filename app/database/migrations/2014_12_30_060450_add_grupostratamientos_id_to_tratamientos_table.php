<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrupostratamientosIdToTratamientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tratamientos', function(Blueprint $table) {
		$table->boolean('grupostratamientos_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tratamientos', function(Blueprint $table) {
			$table->dropColumn('grupostratamientos_id');
		});
	}

}
