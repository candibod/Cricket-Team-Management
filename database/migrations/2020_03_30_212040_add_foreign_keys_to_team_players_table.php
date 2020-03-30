<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTeamPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('team_players', function(Blueprint $table)
		{
			$table->foreign('team_id')->references('id')->on('teams')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('team_players', function(Blueprint $table)
		{
			$table->dropForeign('team_players_team_id_foreign');
		});
	}

}
