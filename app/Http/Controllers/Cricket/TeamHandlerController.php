<?php

namespace App\Http\Controllers\Cricket;

use App\Models\Cricket\Teams;

class TeamHandlerController extends BaseController
{
	/*
	|--------------------------------------------------------------------------
	| Base Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles all the common functionality between the controllers
	|
	*/

	/**
	 * Show list of all the teams.
	 */
	public function showTeamsList()
	{
		$teams = Teams::all();
		$count = $teams->count();

		$data = [
			"teams" => $teams,
			"count" => $count
		];

		return view("app.teams", ["data" => $data]);
	}
}
