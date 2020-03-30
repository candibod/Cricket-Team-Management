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
					<div class="side col-6 @if($match->team_id_1 == $match->winner_team_id) win @endif">
						<h2 class="name">{{ $match->teamId1->name }}</h2>
						@if(is_null($match->teamId1->logo_url))
							<div class="tLogo158x" style="background-position: {{ $match->teamId1->sprite_image_coord }}"></div>
						@else
							<div class="text-center" style="margin: 15px auto">
								<img src="{{ config('cricket.logo_upload_path') . $match->teamId1->logo_url }}" height="158" style="max-width: 90%">
							</div>
						@endif
					</div>
					<div class="versus">
						<span>vs.</span>
					</div>
					<div class="side col-6 @if($match->team_id_2 == $match->winner_team_id) win @endif">
						<h2 class="name">{{ $match->teamId2->name }}</h2>
						@if(is_null($match->teamId2->logo_url))
							<div class="tLogo158x" style="background-position: {{ $match->teamId2->sprite_image_coord }}"></div>
						@else
							<div class="text-center" style="margin: 15px auto">
								<img src="{{ config('cricket.logo_upload_path') . $match->teamId2->logo_url }}" height="158" style="max-width: 90%">
							</div>
						@endif
					</div>
				</div>
			@endforeach
		@else
			<div class="alert alert-warning w-100 text-center mt-3">No Teams are registered in the league, Please click the "+" icons to add a team.</div>
		@endif
	</div>

	<style>
		.sides {
			animation: 0.7s curtain cubic-bezier(0.86, 0, 0.07, 1) 0.4s both;
			/*grid-template-columns: 50vw 50vw;*/
		}

		@keyframes curtain {
			0% {
				grid-gap: 100vw;
			}

			100% {
				grid-gap: 0;
			}
		}

		.intro {
			height: 100%;
			overflow: hidden;
			display: flex;
			justify-content: center;
		}

		.side {
			display: flex;
			flex-direction: column;
			align-items: center;
			background-color: #ee1c26;
			color: #FFFFFF;
			font-size: 6vw;
		}

		.win {
			background-color: #2db774;
		}

		.name {
			margin: 0.3em;
		}

		.versus {
			position: absolute;
			width: 8vw;
			height: 8vw;
			background: #ffffff;
			border-radius: 50%;
			left: 0;
			right: 0;
			bottom: 0;
			top: 0;
			margin: auto;
			z-index: 3;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 3.4vw;
			color: #123456;
			border-width: 10px;
			border-style: solid;
			border-color: #1b636f #dcc9a1 #dcc9a1 #1b636f;
			transform: rotate(-45deg);
		}

		.versus span {
			transform: rotate(35deg);
		}
	</style>

	<a class="btn-floating text-white font-weight-bold add-team-btn">+</a>
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
