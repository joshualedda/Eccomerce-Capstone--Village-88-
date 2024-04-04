<main class="main" id="main">
	<?php if (isset($is_logged_in) && $is_logged_in) : ?>
		<div class="pagetitle">
			<h1 class="text-dark">Profile</h1>
			<nav class="my-2">
				<ol class="breadcrumb">
					<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
					<li class="breadcrumb-item active text-dark">Orders</li>
				</ol>
			</nav>
		</div>


		<div class=" d-flex justify-content-start">

			<div class="col-lg-5">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Personal Information</h5>

						<form id="updateProfile" method="POST" class="row g-3" action="<?= base_url('profile/updateProfile')  ?>">
							<div class="col-12">
								<label for="inputNanme4" class="form-label">First Name</label>
								<input type="text" name="first_name" class="form-control" id="first_name" value="<?= $user_data['first_name'] ?>">
								<span id="firstNameError" class="error text-sm text-danger"><?= form_error('first_name') ?></span>

							</div>
							<div class="col-12">
								<label for="inputEmail4" class="form-label">Last Name</label>
								<input id="last_name" type="text" name="last_name" class="form-control" value="<?= $user_data['last_name'] ?>">
								<span id="lastNameError" class="error text-sm text-danger"><?= form_error('last_name') ?></span>

							</div>


							<div class="text-end">
								<input type="submit" class="btn btn-success" value="Update" />
							</div>
						</form>

					</div>
				</div>
			</div>


			<div class="col-lg-5 mx-5">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Account Information</h5>

						<form id="updateAccount" method="POST" class="row g-3" action="<?= base_url('profile/updatePassword')  ?>">

							<div class="col-12">
								<label for="email" class="form-label">Email</label>
								<input id="email" type="email" class="form-control" name="email" value="<?= $user_data['email'] ?>">
								<span id="emailError" class="error text-sm text-danger"><?= form_error('email') ?></span>

							</div>

							<div class="col-12">
								<label for="inputEmail4" class="form-label">Password</label>
								<input id="password" type="password" class="form-control" name="password">
								<span id="passwordError" class="error text-sm text-danger"><?= form_error('password') ?></span>


							</div>
							<div class="col-12">
								<label for="inputPassword4" class="form-label">Repeat Password</label>
								<input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
								<span id="passwordConfirmError" class="error text-sm text-danger"><?= form_error('password_confirmation') ?></span>


							</div>


							<div class="text-end">
								<input type="submit" class="btn btn-success" value="Update" />
							</div>
						</form>

					</div>
				</div>
			</div>

		</div>


	<?php else : ?>
		<p>Login first to access your profile</p>
	<?php endif; ?>


</main>

<script>
	$(document).ready(function() {
		$("#updateProfile").submit(function(e) {
			e.preventDefault();
			var isItValid = validateProfileForm();
			if (isItValid) {
				var formData = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: $(this).attr("action"),
					data: formData,
					success: function(response) {
						$("#message").html("Profile Update Successfully.");
						$("#liveToast").removeClass("hide");
						$(".toast").toast("show");
					},
					error: function(xhr, status, error) {
						console.log(error);
					}
				});
			}
		});

		$("#updateAccount").submit(function(e) {
			e.preventDefault();
			var isItValid = validateAccountForm();
			if (isItValid) {
				var formData = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: $(this).attr("action"),
					data: formData,
					success: function(response) {
						$("#message").html("Account Successfully Updated.");
						$("#liveToast").removeClass("hide");
						$(".toast").toast("show");
					},
					error: function(xhr, status, error) {
						console.log(error);
					}
				});
			}
		});

		function validateProfileForm() {
			var first_name = $("#first_name").val();
			var last_name = $("#last_name").val();
			$(".error-message").text("");
			var isItValid = true;

			if (first_name.trim() === "") {
				$("#firstNameError").text("First name should not be empty.");
				isItValid = false;
			}

			if (last_name.trim() === "") {
				$("#lastNameError").text("Last name should not be empty.");
				isItValid = false;
			}

			return isItValid;
		}

		function validateAccountForm() {
			var email = $("#email").val();
			var password = $("#password").val();
			var password_confirmation = $("#password_confirmation").val();
			$(".error-message").text("");
			var isItValid = true;

			if (email.trim() === "") {
				$("#emailError").text("Email should not be empty.");
				isItValid = false;
			}

			if (password !== password_confirmation) {
				$("#passwordConfirmError").text("Passwords do not match.");
				isItValid = false;
			}

			return isItValid;
		}
	});
</script>
