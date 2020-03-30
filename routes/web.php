<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
	/*
	 * Since I want multiple parameters in URL path, declared routes rather than using Route::resource
	 * */
	Route::group(['prefix' => 'teams', 'as' => 'teams.', 'namespace' => 'Cricket'], function () {
		Route::get('/', [
			'as'   => 'list',
			'uses' => 'TeamHandlerController@showTeamsList'
		]);

		Route::post('/create', [
			'as'   => 'create',
			'uses' => 'TeamHandlerController@createTeam'
		]);

		Route::group(['as' => 'players.'], function () {
			Route::get('{teamURL}', [
				'as'   => 'list',
				'uses' => 'TeamHandlerController@showTeamPlayers'
			]);

			Route::post('player/{teamId}/create', [
				'as'   => 'create',
				'uses' => 'TeamHandlerController@createTeamPlayer'
			]);
		});
	});

	Route::resource('matches','Cricket\TeamMatchesHandlerController');
});
