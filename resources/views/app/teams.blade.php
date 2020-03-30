@extends('layout.base')

@section('header')
	@include('layout.header')
@endsection

@section('footer')
	@include('layout.footer')
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
@endsection

@section('content')
	<div class="page-heading overflow-hidden row mr-0 ml-0">
		<div class="col-4 page-heading-title">
			<h1 class="ml-3"><i>Teams</i></h1>
		</div>
		<div class="col-8 pr-0 page-heading-backdrop">
			<img src="/assets/images/backdrop.png" alt="Backdrop for title">
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
						<a class="team-card" href="{{ route("teams.players.list", strtolower(str_replace(" ", "-", $team->name))) }}" style="background: linear-gradient(136deg, #{{ $team->team_franchise_color }}c0, #{{ $team->team_franchise_color }}); margin-top: 2rem; border-radius: 0.6em; color: #fff; display: block; overflow: hidden; position: relative; z-index: 0;">
							@if(is_null($team->logo_url))
								<div class="tLogo158x" style="background-position: {{ $team->sprite_image_coord }}"></div>
							@else
								<div class="text-center" style="margin: 15px auto">
									<img src="{{ config('cricket.logo_upload_path') . $team->logo_url }}" height="158" style="max-width: 90%">
								</div>
							@endif
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
				<div class="alert alert-warning w-100 text-center mt-3">No Teams are registered in the league, Please click the "+" icons to add a team.</div>
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
