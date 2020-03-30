<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchPointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('match_points', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('match_id')->unsigned()->index('match_points_match_id_foreign');
			$table->boolean('points')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('match_points');
	}

}
