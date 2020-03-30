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
							<label for="inputName">Team Name *</label>
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Sunrisers Hyderabad">
						</div>
						<div class="form-group col-md-12">
							<label for="customFile">Franchise Logo *</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<small>Supported file type: jpg, jpeg, png. Max image size: 1MB</small>
						</div>
						<div class="form-group col-md-6">
							<label for="inputColor">Franchise Color in HEX <small>(optional)</small></label>
							<input type="text" class="form-control" id="inputColor" name="inputColor" placeholder="F5F5F5">
						</div>
						<div class="form-group col-md-6">
							<label for="inputState">State <small>(optional)</small></label>
							<input type="text" class="form-control" id="inputState" name="inputState" placeholder="Telangana">
						</div>
					</div>
					<div class="text-center mt-4">
						<button type="submit" class="btn btn-primary" id="FormTeamRegistrationSubmitBtn">CREATE TEAM</button>
						<button type="button" class="btn btn-primary d-none" id="FormTeamRegistrationLoadingBtn">Submitting...</button>
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
				Team has been created successfully
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

			$('#FormTeamRegistration').submit(function (e) {
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
							$('#TeamRegisterModal').modal('hide');
							$('#FormSuccessModal').modal('show');
							setTimeout(function () {
								location.reload();
							}, 3000);
						} else if (data.error) {
							$('#TeamRegisterModal').modal('show');
							new Noty({
								type: 'error',
								layout: 'topRight',
								text: data.error,
								timeout: 2500,
							}).show();
						} else {
							$('#TeamRegisterModal').modal('show');
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
				$("#FormTeamRegistrationSubmitBtn").addClass("d-none");
				$("#FormTeamRegistrationLoadingBtn").removeClass("d-none");
			}

			function showSubmitButton() {
				$("#FormTeamRegistrationSubmitBtn").removeClass("d-none");
				$("#FormTeamRegistrationLoadingBtn").addClass("d-none");
			}
		});
	</script>
@endsection