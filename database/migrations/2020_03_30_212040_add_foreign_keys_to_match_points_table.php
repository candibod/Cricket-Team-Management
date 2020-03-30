<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatchPointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('match_points', function(Blueprint $table)
		{
			$table->foreign('match_id')->references('id')->on('matches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('match_points', function(Blueprint $table)
		{
			$table->dropForeign('match_points_match_id_foreign');
		});
	}

}
