@extends('layout.base')

@section('content')
	<style>
		.tLogo158x {
			background-image: url("/assets/sprites/tLogo158x-sprite.png");
			background-repeat: no-repeat;
			display: block;
			width: 158px;
			height: 158px;
			background-position: -632px 0;
			margin: 15px auto;
		}

		.tLogo158x.CSK {
			background-position: -158px 0
		}

		.tLogo158x.DC {
			background-position: -474px 0
		}

		.tLogo158x.DD {
			background-position: 0 -158px
		}

		.tLogo158x.DEC {
			background-position: -158px -158px
		}

		.tLogo158x.GL {
			background-position: -316px 0
		}

		.tLogo158x.KKR {
			background-position: -316px -158px
		}

		.tLogo158x.KTK {
			background-position: 0 -316px
		}

		.tLogo158x.KXIP {
			background-position: -158px -316px
		}

		.tLogo158x.MI {
			background-position: -316px -316px
		}

		.tLogo158x.PWI {
			background-position: 0 0
		}

		.tLogo158x.RCB {
			background-position: -474px -158px
		}

		.tLogo158x.RPS {
			background-position: -474px -316px
		}

		.tLogo158x.RR {
			background-position: 0 -474px
		}

		.tLogo158x.SPN {
			background-position: -158px -474px
		}

		.tLogo158x.SRH {
			background-position: -316px -474px
		}

		.tLogo158x.TBC {
			background-position: -474px -474px
		}

		.tLogo158x.TBD {
			background-position: -632px 0
		}

		.tLogo158x.TRL {
			background-position: -632px -158px
		}

		.tLogo158x.VEL {
			background-position: -632px -316px
		}

		.card__inner.DC {
			background: linear-gradient(136deg, #004C93, #0358A7)
		}

		.card__inner.GL {
			background: linear-gradient(136deg, #E4660B, #B35009)
		}

		.card__inner.KKR {
			background: linear-gradient(136deg, #70458F, #3D2057)
		}

		.card__inner.KXIP {
			background: linear-gradient(136deg, #AA4545, #740F0B)
		}

		.card__inner.MI {
			background: linear-gradient(136deg, #005DA0, #003A63)
		}

		.card__inner.RCB {
			background: linear-gradient(136deg, #000000, #464646)
		}

		.card__inner.RPS {
			background: linear-gradient(136deg, #153359, #0B1B30)
		}

		.card__inner.SRH {
			background: linear-gradient(136deg, #FB643E, #B81C25)
		}

		.card__inner.CSK {
			background: linear-gradient(136deg, #FDB913, #F85C00)
		}

		.card__inner.RR {
			background: linear-gradient(136deg, #2D4D9D, #172E5E)
		}

		.card__inner.SPN {
			background: linear-gradient(136deg, #31B8DE, #124679)
		}

		.card__inner.TRL {
			background: linear-gradient(136deg, #B01F68, #671A56)
		}

		.card__inner.VEL {
			background: linear-gradient(136deg, #522583, #1D1D1B)
		}

		header {
			background-color: #19398a;
			color: #fff;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 100;
			box-shadow: 0 4px 8px 0 hsla(0, 0%, 7%, .5);
		}

		header a, header a:hover {
			color: #FFFFFF;
		}

		.page-heading {
			background-image: linear-gradient(265deg, #04143a, #19398a);
			height: 140px;
			z-index: 30;
			margin-top: 55px;
		}

		.page-heading img {
			float: right;
			width: 60rem;
		}

		.page-heading .page-heading-title {
			z-index: 10;
		}

		.page-heading h1 {
			font-weight: 600;
			font-size: 3.2rem;
			margin-top: 30px;
			color: #FFFFFF;
			z-index: 2;
		}

		.team-card {
			height: 294px;
		}

		.team-name {
			font-size: 20px;
		}

		@media (max-width: 920px) {
			.page-heading .page-heading-backdrop {
				display: none;
			}

			.page-heading h1 {
				font-size: 2rem;
				margin-top: 48px;
			}
		}
	</style>
	<header class="p-3">
		<div class="row">
			<h5 class="col col-5 mb-0">CPL 2020</h5>
			<nav class="col text-right">
				<a class="mr-3" href="#">Teams</a>
				<a href="#">Matches</a>
			</nav>
		</div>
	</header>

	<div class="page-heading overflow-hidden row mr-0 ml-0">
		<div class="col-4 page-heading-title">
			<h1 class="ml-3"><i>Teams</i></h1>
		</div>
		<div class="col-8 pr-0 page-heading-backdrop">
			<img src="/assets/images/backdrop.png" alt="Backdrop for title">
		</div>
	</div>

	<div class="container">
		<div class="row">
			@foreach($teams as $team)
				@php $name = explode(" ", $team->name) @endphp
				<div class="col-3 col-md-4 col-lg-3">
					<a class="card team-card card__inner {{ $team->short_name }}" href="/teams/chennai-super-kings" style="margin-top: 2rem; border-radius: 0.6em; color: #fff; display: block; overflow: hidden; position: relative; z-index: 0;">
						<div class="tLogo158x {{ $team->short_name }}"></div>
						<div class="text-center mb-3">
							<p class="font-weight-bold team-name mb-1">
								{{ $team->name }}
							</p>
							{{ $team->club_state }}
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>

	<footer class="container py-5">
		<div class="row">
			<div class="col-12">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24" focusable="false">
					<title>Product</title>
					<circle cx="12" cy="12" r="10"></circle>
					<path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"></path>
				</svg>
				<small class="d-block mb-3 text-muted">© 2017-2019</small>
			</div>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
