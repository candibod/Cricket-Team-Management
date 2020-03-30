<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('team_players', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('team_id')->unsigned()->index('team_players_team_id_foreign');
			$table->string('first_name', 20);
			$table->string('last_name', 20);
			$table->text('image_url', 65535);
			$table->boolean('jersey_number')->nullable();
			$table->string('country', 16)->nullable();
			$table->integer('matches_played')->nullable();
			$table->integer('runs_scored')->nullable();
			$table->boolean('highest_score')->nullable();
			$table->boolean('wickets')->nullable();
			$table->boolean('fifties')->nullable();
			$table->boolean('hundreds')->nullable();
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
		Schema::drop('team_players');
	}

}
