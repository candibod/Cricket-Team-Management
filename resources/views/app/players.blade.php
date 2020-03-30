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
		<div class="text-center w-100">
			<h1>{{ $data["team"]->name }}</h1>
		</div>
	</div>

	<div class="container mb-2">
		<div class="row">
			@if ($data["count"] > 0)
				@foreach($data["players"] as $player)
					<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
						<div class="player-card" style="background: linear-gradient(136deg, #{{ $data["team"]->team_franchise_color }}c0, #{{ $data["team"]->team_franchise_color }}); margin-top: 2rem; border-radius: 0.6em; color: #fff; display: block; overflow: hidden; position: relative; z-index: 0;">
							<div class="text-center" style="margin: 15px auto 0 auto">
								<img src="{{ config('cricket.player_image_path') . $player->image_url }}" height="158" style="max-width: 90%">
							</div>
							<div class="text-center" style="height: 100%; background-color: white; color: #333333">
								<p class="font-weight-bold player-name pt-1 mb-0">{{ $player->first_name . " " . $player->last_name }}</p>
								@if(!is_null($player->country))
									{{ $player->country }}
								@else
									--
								@endif
								<div class="col-12 mt-2 player-info">
									<div class="row player-career">
										<div class="col-4 pr-2"><b>@if(is_null($player->matches_played)) 0 @else{{ $player->matches_played }}@endif</b><br>Matches</div>
										<div class="col-4 pl-0 pr-0" style="border-left: 1px solid #333333; border-right: 1px solid #333333;"><b>@if(is_null($player->runs_scored)) 0 @else{{ $player->runs_scored }}@endif</b><br>Runs</div>
										<div class="col-4 pl-2"><b>@if(is_null($player->highest_score)) 0 @else{{ $player->highest_score }}@endif</b><br>Highest</div>
										<div class="col-12 text-center mt-3"><a href="#" class="player-career-btn" style="color: #333333"><b>SHOW STATS</b></a></div>
									</div>
									<div class="row player-stats d-none">
										<div class="col-4 pr-2"><b>@if(is_null($player->wickets)) 0 @else{{ $player->wickets }}@endif</b><br>Wickets</div>
										<div class="col-4 pl-0 pr-0" style="border-left: 1px solid #333333; border-right: 1px solid #333333;"><b>@if(is_null($player->fifties)) 0 @else{{ $player->fifties }}@endif</b><br>50's</div>
										<div class="col-4 pl-2"><b>@if(is_null($player->hundreds)) 0 @else{{ $player->hundreds }}@endif</b><br>100's</div>
										<div class="col-12 text-center mt-3"><a href="#" class="player-stats-btn" style="color: #333333"><b>CAREER INFO</b></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning w-100 text-center mt-3">No players are registered in this team, Please click the "+" icons to add a team.</div>
			@endif
		</div>
	</div>

	<div class="btn-floating text-white font-weight-bold add-player-btn">+</div>

	@include('modals.create-player')
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.player-career-btn').on("click", function () {
				$(this).parent().parent().addClass("d-none");
				$(this).parent().parent().next().removeClass("d-none");
			});

			$('.player-stats-btn').on("click", function () {
				$(this).parent().parent().addClass("d-none");
				$(this).parent().parent().prev().removeClass("d-none");
			});

			$(".add-player-btn").on("click", function () {
				$("#PlayerRegisterModal").modal({
					'show': true,
					'backdrop': 'static',
					'keyboard': false
				});
			});
		});
	</script>
@endsection