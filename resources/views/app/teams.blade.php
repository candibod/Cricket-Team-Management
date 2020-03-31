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
			<h1 class="ml-3"><i>Teams</i></h1>
		</div>
		<div class="col-8 pr-0 page-heading-backdrop">
			<img src="/assets/images/static/backdrop.png" alt="Backdrop for title">
		</div>
	</div>

	<div class="container mb-2">
		<div class="row">
			@if ($data["count"] > 0)
				@foreach($data["teams"] as $team)
					@php
						$string = $team->name; $strpos = strrpos($string, " "); $string = $strpos > 0 ? substr($string, 0, $strpos) . "<br>" . substr($string , $strpos + 1) : $string;
					@endphp
					<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
						<a class="team-card" href="{{ route("teams.players.list", strtolower(str_replace(" ", "-", $team->name))) }}" style="background: linear-gradient(136deg, #{{ $team->team_franchise_color }}c0, #{{ $team->team_franchise_color }});">
							<div class="text-center team-logo-section">
								<img src="{{ config('cricket.logo_upload_path') . $team->logo_url }}" height="158">
							</div>
							<div class="text-center mb-3">
								<p class="font-weight-bold team-name mb-3">{!! $string !!}</p>
								@if(!is_null($team->club_state))
									{{ $team->club_state }}
								@else
									--
								@endif
							</div>
						</a>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning w-100 text-center mt-3">No Teams are registered in the league, Please click the "+" icon to add a team.</div>
			@endif
		</div>
	</div>

	<div class="btn-floating text-white font-weight-bold add-team-btn">+</div>

	@include('modals.create-team')
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$(".add-team-btn").on("click", function () {
				$("#TeamRegisterModal").modal({
					'show': true,
					'backdrop': 'static',
					'keyboard': false
				});
			});
		});
	</script>
@endsection
