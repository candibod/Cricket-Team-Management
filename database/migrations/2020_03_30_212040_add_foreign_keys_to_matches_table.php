<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			$table->foreign('team_id_1')->references('id')->on('teams')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('team_id_2')->references('id')->on('teams')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('winner_team_id')->references('id')->on('teams')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			$table->dropForeign('matches_team_id_1_foreign');
			$table->dropForeign('matches_team_id_2_foreign');
			$table->dropForeign('matches_winner_team_id_foreign');
		});
	}

}
