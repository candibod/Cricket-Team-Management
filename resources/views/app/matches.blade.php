@extends('layout.base')

@section('header')
	@include('layout.header')
@endsection

@section('footer')
	@include('layout.footer')
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}"/>
@endsection

@section('content')
	<div class="page-heading overflow-hidden row mr-0 ml-0">
		<div class="col-4 page-heading-title">
			<h1 class="ml-3"><i>Matches</i></h1>
		</div>
		<div class="col-8 pr-0 page-heading-backdrop">
			<img src="/assets/images/backdrop.png" alt="Backdrop for title">
		</div>
	</div>

	<div class="container mb-2">
		@if ($data["count"] > 0)
			@foreach($data["matches"] as $match)
				<div class="row mt-4">
					<div class="side position-relative col-6 @if($match->team_id_1 == $match->winner_team_id) win @endif">
						<h2 class="mt-3 name">{{ $match->teamId1->name }}</h2>
						<p>Points: @if($match->team_id_1 == $match->winner_team_id) {{ $match->points->points }} @else 0 @endif</p>
						<div class="text-center" style="margin: 15px auto">
							<img src="{{ config('cricket.logo_upload_path') . $match->teamId1->logo_url }}" height="158" style="max-width: 90%">
						</div>
						<div class="versus">
							<span style="margin-left: 23px">vs</span>
						</div>
					</div>
					<div class="side col-6 @if($match->team_id_2 == $match->winner_team_id) win @endif">
						<h2 class="mt-3 name">{{ $match->teamId2->name }}</h2>
						<p>Points: @if($match->team_id_2 == $match->winner_team_id) {{ $match->points->points }} @else 0 @endif</p>
						<div class="text-center" style="margin: 15px auto">
							<img src="{{ config('cricket.logo_upload_path') . $match->teamId2->logo_url }}" height="158" style="max-width: 90%">
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="alert alert-warning w-100 text-center mt-3">No Fixtures happened in the league, Please click the "+" icon to add a fixture.</div>
		@endif
	</div>

	<style>
		.side {
			display: flex;
			flex-direction: column;
			align-items: center;
			background-color: #ee1c26;
			color: #FFFFFF;
		}

		.win {
			background-color: #2db774;
		}

		.name {
			font-size: 22px;
		}

		.versus {
			position: absolute;
			width: 100px;
			height: 100px;
			background: #ffffff;
			border-radius: 50%;
			right: -50px;
			bottom: 0;
			top: 0;
			margin: auto;
			z-index: 3;
			font-size: 45px;
			color: #123456;
			border: 5px solid #2db774;
			transform: rotate(-45deg);
		}
	</style>

	<form method="post" id="CreateFixture" action="{{ route("matches.store") }}" class="d-none">
		{{ csrf_field() }}
		<button type="submit"></button>
	</form>

	<a class="btn-floating text-white font-weight-bold add-team-btn" style="text-decoration: none;" href="#">+</a>
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$(".add-team-btn").on("click", function () {
				$("#CreateFixture").submit();
			});
		});
	</script>
@endsection
