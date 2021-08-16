<?php

namespace App\Http\Controllers\Cricket;

use App\Models\Cricket\Players;
use App\Models\Cricket\Teams;
use Illuminate\Support\Facades\Validator;

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

	public function defaultRouteRedirect()
	{
		return redirect(route("teams.list"));
	}

	/**
	 * Show list of all the teams.
	 */
	public function showTeamsList()
	{
		$teams = Teams::all();

		$data = [
			"teams" => $teams,
			"count" => $teams->count()
		];

		return view("app.teams", ["data" => $data]);
	}

	public function createTeam()
	{
		$rules = [
			"inputName"  => "required|regex:/^[a-zA-Z\s]+$/u",
			"customFile" => "required|mimes:jpg,jpeg,png|max:1024",
		];

		if (!is_null(request()->input('inputColor'))) {
			$rules['inputColor'] = "between:6,6|regex:/^[a-fA-F0-9\s]+$/u";
		}

		if (!is_null(request()->input('inputState'))) {
			$rules['inputState'] = "regex:/^[a-zA-Z\s]+$/u";
		}

		$messages = [
			"inputName.required"  => "Please enter the team name",
			"inputName.regex"     => "Team name should not have any special characters",
			'inputColor.alpha'    => 'Please enter a valid color HEX code',
			'inputColor.between'  => 'Please enter a valid color HEX code',
			'inputColor.regex'    => 'Color format is invalid',
			'inputState.regex'    => 'State name should not have any special characters',
			'customFile.required' => 'Please upload the team logo',
			'customFile.mimes'    => 'Uploaded file format is not valid. (only .jpg, .jpeg, .png are accepted)',
			'customFile.max'      => 'Logo size cannot be more than 1 MB'
		];

		$validator = Validator::make(request()->all(), $rules, $messages);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'error'   => $validator->messages()->first()
			]);
		}

		$name = request()->input('inputName');
		$color = request()->input('inputColor');
		$state = request()->input('inputState');
		$logo = request()->file('customFile');

		try {
			// upload the image to server
			$fullUploadTo = config('cricket.logo_upload_path');
			$newImageName = str_replace(" ", "-", $name) . time() . "." . $logo->getClientOriginalExtension();

			// move to the correct place
			move_uploaded_file($logo->getRealPath(), public_path() . $fullUploadTo . $newImageName);

			Teams::create([
				'name'                 => $name,
				'team_franchise_color' => !is_null($color) ? $color : "122122",
				'club_state'           => $state,
				'logo_url'             => $newImageName
			]);

			return response()->json(['success' => true]);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'error'   => 'Some error while uploading, please try again after some time'
			]);
		}
	}

	public function showTeamPlayers($teamUrl)
	{
		$team = Teams::where("name", str_replace("-", " ", $teamUrl))
			->first();

		if (!$team) {
			return redirect(route("teams.list"));
		}

		$players = Players::where("team_id", $team->id)
			->get();

		$data = [
			"team"    => $team,
			"players" => $players,
			"count"   => $players->count()
		];

		return view("app.players", ["data" => $data]);
	}

	public function createTeamPlayer($teamId)
	{
		if ($teamId > 0) {
			$team = Teams::find($teamId);

			if (!$team) {
				return response()->json([
					'success' => false,
					'error'   => 'Some error while uploading, please reload the page'
				]);
			}

			$rules = [
				"firstName"  => "required|regex:/^[a-zA-Z\s]+$/u",
				"lastName"   => "required|regex:/^[a-zA-Z\s]+$/u",
				"customFile" => "required|mimes:jpg,jpeg,png|max:1024",
			];

			$messages = [
				"firstName.required"  => "Please enter the first name",
				"firstName.regex"     => "First name should not have any special characters",
				"lastName.required"   => "Please enter the last name",
				"lastName.regex"      => "Last name should not have any special characters",
				'country.regex'       => 'Country should not have any special characters',
				'customFile.required' => 'Please upload the team logo',
				'customFile.mimes'    => 'Uploaded file format is not valid. (only .jpg, .jpeg, .png are accepted)',
				'customFile.max'      => 'Logo size cannot be more than 1 MB'
			];

			$additionalInputs = ["jerseyNumber", "matchesPlayed", "runsScored", "wickets", "highest", "fifties", "hundreds"];
			foreach ($additionalInputs as $input) {
				if (!is_null(request()->input($input))) {
					$rules[$input] = "digits_between:1,3";
					$messages[$input . ".digits_between"] = "Please enter a valid value for " . $input . ", should be less than 999";
				}
			}

			if (!is_null(request()->input('country'))) {
				$rules['country'] = "regex:/^[a-zA-Z\s]+$/u";
			}

			$validator = Validator::make(request()->all(), $rules, $messages);
			if ($validator->fails()) {
				return response()->json([
					'success' => false,
					'error'   => $validator->messages()->first()
				]);
			}

			try {

				$name = request()->input('firstName') . " " . request()->input('lastName');
				$logo = request()->file('customFile');

				// upload the image to server
				$fullUploadTo = config('cricket.player_image_path');
				$newImageName = str_replace(" ", "-", $name) . time() . "." . $logo->getClientOriginalExtension();

				// move to the correct place
				move_uploaded_file($logo->getRealPath(), public_path() . $fullUploadTo . $newImageName);

				Players::create([
					'team_id'        => $teamId,
					'first_name'     => request()->input('firstName'),
					'last_name'      => request()->input('lastName'),
					'image_url'      => $newImageName,
					'jersey_number'  => request()->input('jerseyNumber'),
					'country'        => request()->input('country'),
					'matches_played' => request()->input('matchesPlayed'),
					'runs_scored'    => request()->input('runsScored'),
					'highest_score'  => request()->input('highest'),
					'wickets'        => request()->input('wickets'),
					'fifties'        => request()->input('fifties'),
					'hundreds'       => request()->input('hundreds'),
				]);

				return response()->json(['success' => true]);
			} catch (\Exception $e) {
				return response()->json([
					'success' => false,
					'error'   => 'Some error while uploading, please try again after some time'
				]);
			}
		}

		return response()->json([
			'success' => false,
			'error'   => 'Some error while uploading, please reload the page'
		]);
	}
}
