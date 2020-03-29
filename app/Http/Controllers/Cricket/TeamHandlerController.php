<?php

namespace App\Http\Controllers\Cricket;

use App\Models\Cricket\Teams;
use Illuminate\Support\Facades\Log;
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

	public function createTeam()
	{
		$rules = [
			"inputName"  => "required|regex:/^[\pL\s]+$/u",
			"customFile" => "required|mimes:jpg,jpeg,png|max:1024",
		];

		if (!is_null(request()->input('inputcolor')))
		{
			$rules['inputColor'] = ["alpha|max:6s"];
		}

		if (!is_null(request()->input('inputState')))
		{
			$rules['inputState'] = ["regex:/^[\pL\s]+$/u"];
		}

		$messages = [
			"inputName.required"  => "Please enter the team name",
			"inputName.regex"     => "Team name should not have any special characters",
			'inputColor.alpha'    => 'Please enter a valid color HEX code',
			'inputColor.max'      => 'Please enter a valid color HEX code',
			'inputState.regex'    => 'State name should not have any special characters',
			'customFile.required' => 'Please upload the team logo',
			'customFile.mimes'    => 'Uploaded file format is not valid. (only .jpg, .jpeg, .png are accepted)',
			'customFile.max'      => 'Logo size cannot be more than 1 MB'
		];

		$validator = Validator::make(request()->all(), $rules, $messages);
		if ($validator->fails())
		{
			return response()->json([
				                        'success' => false,
				                        'error'   => $validator->messages()->first()
			                        ]);
		}

		return response()->json([
			                        'success' => false,
			                        'errors'  => $validator->messages()->first()
		                        ]);
	}
}
