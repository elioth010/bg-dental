<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sedes_users', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('sede_id');
                        $table->integer('user_id');
                        
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sedes_users', function(Blueprint $table)
		{
			//
		});
	}

}
