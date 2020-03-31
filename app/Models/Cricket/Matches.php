<?php

namespace App\Models\Cricket;

use App\Models\BaseModel;

class Matches extends BaseModel
{
	protected $table = 'matches';

	public function teamId1()
	{
		return $this->belongsTo(Teams::class, 'team_id_1');
	}

	public function teamId2()
	{
		return $this->belongsTo(Teams::class, 'team_id_2');
	}

	public function points()
	{
		return $this->hasOne(MatchPoints::class, 'match_id');
	}
}
