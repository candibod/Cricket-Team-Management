<?php

namespace App\Http\Controllers\Cricket;

use App\Models\Cricket\Matches;
use App\Models\Cricket\MatchPoints;
use App\Models\Cricket\Teams;

class TeamMatchesHandlerController extends BaseController
{
	public function index()
	{
		$matches = Matches::all();

		$data = [
			"matches" => $matches,
			"count"   => $matches->count()
		];

		return view("app.matches", ["data" => $data]);
	}

	public function create()
	{
		return redirect(route("matches.index"));
	}

	/*
	 * Default redirect/responses
	 * */
	public function store()
	{
		$teamIds = Teams::all()
		                ->pluck("id")
		                ->toArray();

		if (count($teamIds) < 2)
		{
			return redirect(route("matches.index"))
				->with('error', 'Minimum 2 teams are needed to create a match, Please go to teams page & create atleast 2 teams.');
		}

		$randomArray = array_rand($teamIds, "2");
		$teamId1 = $teamIds[$randomArray[0]];
		$teamId2 = $teamIds[$randomArray[1]];

		$match = Matches::create([
			                         "team_id_1"      => $teamId1,
			                         "team_id_2"      => $teamId2,
			                         "winner_team_id" => (time() % 2 == 0) ? $teamId1 : $teamId2,
		                         ]);

		MatchPoints::create([
			                    "match_id" => $match->id,
			                    "points"   => 2
		                    ]);

		return redirect(route("matches.index"))
			->with('success', 'Random Fixture created successfully.');
	}

	public function show()
	{
		return redirect(route("matches.index"));
	}

	public function edit()
	{
		return redirect(route("matches.index"));
	}

	public function update()
	{
		return response()->json([
			                        "success" => true
		                        ]);
	}

	public function destroy()
	{
		return response()->json([
			                        "success" => true
		                        ]);
	}
}
