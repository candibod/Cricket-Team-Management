<?php

namespace App\Http\Controllers\Cricket;

use App\Models\Cricket\Matches;

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

	public function store(Request $request)
	{

	}

	public function show(Product $product)
	{
	}

	public function edit(Product $product)
	{
	}

	public function update(Request $request, Product $product)
	{
	}

	public function destroy(Product $product)
	{
	}
}
