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
						<a class="team-card" href="{{ route("teams.list") }}" style="background: linear-gradient(136deg, #{{ $team->team_franchise_color }}c0, #{{ $team->team_franchise_color }}); margin-top: 2rem; border-radius: 0.6em; color: #fff; display: block; overflow: hidden; position: relative; z-index: 0;">
							<div class="tLogo158x" style="background-position: {{ $team->sprite_image_coord }}"></div>
							<div class="text-center mb-3">
								<p class="font-weight-bold team-name mb-3">{!! $string !!}</p>{{ $team->club_state }}
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

	<div class="modal fade" id="TeamRegisterModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Register New Team</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="FormTeamRegistration" action="{{ route("teams.create") }}" method="POST">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputName">Team Name</label>
								<input type="text" class="form-control" id="inputName" placeholder="Sunrisers Hyderabad">
							</div>
							<div class="form-group col-md-6">
								<label for="inputState">State <small>(optional)</small></label>
								<input type="text" class="form-control" id="inputState" placeholder="Telangana">
							</div>
							<div class="form-group col-md-6">
								<label for="inputColor">Franchise Color <small>(optional)</small></label>
								<input type="text" class="form-control" id="inputColor" placeholder="#d64363">
							</div>
						</div>
						<div class="form-group">
							<label for="customFile">Franchise Logo</label>
						    <div class="custom-file">
						      <input type="file" class="custom-file-input" id="customFile" name="filename">
						      <label class="custom-file-label" for="customFile">Choose file</label>
						    </div>
								<small>Supported file type: jpg, jpeg, png. Max image size: 1MB</small>
						</div>
						<div class="text-center mt-4">
							<button type="button" class="btn btn-primary">CREATE TEAM</button>
							<button id="btnJobApplicationSubmit" type="submit" class="btn btn-primary btn-submit">
								<div class="default">
									<i class="material-icons valign-mid">&#xE2C6;</i>
									<span class="valign-mid">Submit</span>
								</div>
								<div class="waiting hide">
									<i class="material-icons valign-mid">&#xE2C6;</i>
									<span class="valign-mid">Submitting..</span>
								</div>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			var $button = $("#TeamRegisterModal");

			$(".add-team-btn").on("click", function () {
				$button.modal("show");
			});

			$('#FormTeamRegistration').submit(function (e) {
				e.preventDefault();

				var btnSubmit = $('#btnJobApplicationSubmit');

				function hideSubmitButton() {
					btnSubmit.attr('disabled', true);
					btnSubmit.find('.default').addClass('hide');
					btnSubmit.find('.waiting').removeClass('hide');
				}

				function showSubmitButton() {
					btnSubmit.attr('disabled', false);
					btnSubmit.find('.default').removeClass('hide');
					btnSubmit.find('.waiting').addClass('hide');
				}

				var formUrl = $(this).attr('action');
				hideSubmitButton();

				$.ajax({
					url: formUrl,
					type: "POST",
					data: new FormData(this),
					cache: false,
					processData: false,
					contentType: false,
					success: function (data) {
						showSubmitButton();
						if (data.success) {
							$('#TeamRegisterModal').modal('hide');
							$('#FormSuccessModal').modal('show');
						} else if (data.error) {
							$('#TeamRegisterModal').modal('show');
							window.showNotyError(data.error);
						} else {
							$('#TeamRegisterModal').modal('show');
							window.showNotyError("Some error occurred while submitting your request")
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						showSubmitButton();
						window.showNotyError("Some error occurred while submitting your request");
						window.notifyTeam({
							"url": url,
							"textStatus": textStatus,
							"errorThrown": errorThrown
						});
					}
				});
			});
		});
	</script>
@endsection
