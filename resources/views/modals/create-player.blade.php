<div class="modal fade" id="PlayerRegisterModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Register New Player</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="FormPlayerRegistration" action="{{ route("teams.players.create", $data["team"]->id) }}" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="firstName">First Name *</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="david">
						</div>
						<div class="form-group col-md-6">
							<label for="lastName">Last Name *</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="warner">
						</div>
						<div class="form-group col-md-12">
							<label for="customFile">Player Image *</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<small>Supported file type: jpg, jpeg, png. Max image size: 1MB</small>
						</div>
						<div class="form-group col-md-6">
							<label for="jerseyNumber">Jersey Number <small>(optional)</small></label>
							<input type="text" class="form-control" id="jerseyNumber" name="jerseyNumber" placeholder="38">
						</div>
						<div class="form-group col-md-6">
							<label for="country">Country <small>(optional)</small></label>
							<input type="text" class="form-control" id="country" name="country" placeholder="india">
						</div>
						<div class="form-group col-md-6">
							<label for="matchesPlayed">Matches Played <small>(optional)</small></label>
							<input type="text" class="form-control" id="matchesPlayed" name="matchesPlayed" placeholder="19">
						</div>
						<div class="form-group col-md-6">
							<label for="runsScored">Runs Scored <small>(optional)</small></label>
							<input type="text" class="form-control" id="runsScored" name="runsScored" placeholder="654">
						</div>
						<div class="form-group col-md-6">
							<label for="wickets">Wickets <small>(optional)</small></label>
							<input type="text" class="form-control" id="wickets" name="wickets" placeholder="15">
						</div>
						<div class="form-group col-md-6">
							<label for="highest">Highest <small>(optional)</small></label>
							<input type="text" class="form-control" id="highest" name="highest" placeholder="125">
						</div>
						<div class="form-group col-md-6">
							<label for="fifties">50's <small>(optional)</small></label>
							<input type="text" class="form-control" id="fifties" name="fifties" placeholder="8">
						</div>
						<div class="form-group col-md-6">
							<label for="hundreds">100's <small>(optional)</small></label>
							<input type="text" class="form-control" id="hundreds" name="hundreds" placeholder="3">
						</div>
					</div>
					<div class="text-center mt-4">
						<button type="submit" class="btn btn-primary" id="FormPlayerRegistrationSubmitBtn">CREATE PLAYER</button>
						<button type="button" class="btn btn-primary d-none" id="FormPlayerRegistrationLoadingBtn">Submitting...</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="FormSuccessModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content text-center">
			<h3 class="mt-4">Hurrayyy :-)</h3>
			<br>
			<p class="">
				Player has been created successfully
			</p>
		</div>
	</div>
</div>

@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function () {
			// Add the following code if you want the name of the file appear on select
			$(".custom-file-input").on("change", function () {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});

			$('#FormPlayerRegistration').submit(function (e) {
				e.preventDefault();
				hideSubmitButton();

				$.ajax({
					url: $(this).attr('action'),
					type: "POST",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: new FormData(this),
					dataType: "json",
					processData: false,
					contentType: false,
					success: function (data) {
						showSubmitButton();
						if (data.success) {
							$('#PlayerRegisterModal').modal('hide');
							$('#FormSuccessModal').modal('show');
							setTimeout(function () {
								location.reload();
							}, 3000);
						} else if (data.error) {
							$('#PlayerRegisterModal').modal('show');
							new Noty({
								type: 'error',
								layout: 'topRight',
								text: data.error,
								timeout: 2500,
							}).show();
						} else {
							$('#PlayerRegisterModal').modal('show');
							new Noty({
								type: 'error',
								layout: 'topRight',
								text: "OOPS!! looks like there is an issue with your submission, Please try again after some time."
							}).show();
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						showSubmitButton();
						new Noty({
							type: 'error',
							layout: 'topRight',
							text: "OOPS!! looks like there is an issue with your submission, Please try again after some time."
						}).show();
					}
				});
			});

			function hideSubmitButton() {
				$("#FormPlayerRegistrationSubmitBtn").addClass("d-none");
				$("#FormPlayerRegistrationLoadingBtn").removeClass("d-none");
			}

			function showSubmitButton() {
				$("#FormPlayerRegistrationSubmitBtn").removeClass("d-none");
				$("#FormPlayerRegistrationLoadingBtn").addClass("d-none");
			}
		});
	</script>
@endsection