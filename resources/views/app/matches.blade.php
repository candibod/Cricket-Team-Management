@extends('layout.base')

@section('header')
	@include('layout.header')
@endsection

@section('footer')
	@include('layout.footer')
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}"/>
@endsection

@section('content')
	<div class="page-heading overflow-hidden row mr-0 ml-0">
		<div class="col-4 page-heading-title">
			<h1 class="ml-3"><i>Matches</i></h1>
		</div>
		<div class="col-8 pr-0 page-heading-backdrop">
			<img src="/assets/images/static/backdrop.png" alt="Backdrop for title">
		</div>
	</div>

	<div class="container mb-2">
		@if ($data["count"] > 0)
			@foreach($data["matches"] as $match)
				<div class="row mt-4 ml-1 mr-1">
					<div class="side text-center position-relative col-6 @if($match->team_id_1 == $match->winner_team_id) win @endif">
						<h2 class="mt-3 name">{{ $match->teamId1->name }}</h2>
						<p class="mb-0">Points: @if($match->team_id_1 == $match->winner_team_id) {{ $match->points->points }} @else 0 @endif</p>
						<div class="matches-logo-section">
							<img src="{{ config('cricket.logo_upload_path') . $match->teamId1->logo_url }}" height="100">
						</div>
						<div class="versus">
							<span>vs</span>
						</div>
					</div>
					<div class="side text-center col-6 @if($match->team_id_2 == $match->winner_team_id) win @endif">
						<h2 class="mt-3 name">{{ $match->teamId2->name }}</h2>
						<p class="mb-0">Points: @if($match->team_id_2 == $match->winner_team_id) {{ $match->points->points }} @else 0 @endif</p>
						<div class="matches-logo-section">
							<img src="{{ config('cricket.logo_upload_path') . $match->teamId2->logo_url }}" height="100">
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="alert alert-warning w-100 text-center mt-3">No Fixtures happened in the league, Please click the "+" icon to add a fixture.</div>
		@endif
	</div>

	<form method="post" id="CreateFixture" action="{{ route("matches.store") }}" class="d-none">
		{{ csrf_field() }}
		<button type="submit"></button>
	</form>

	<div class="btn-floating text-white font-weight-bold add-matches-btn">+</div>
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$(".add-matches-btn").on("click", function () {
				$("#CreateFixture").submit();
			});
		});
	</script>
@endsection
