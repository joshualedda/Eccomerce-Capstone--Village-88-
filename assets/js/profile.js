$(document).ready(function() {
	$("#updateProfile").submit(function(e) {
		e.preventDefault();
		if (validateProfileForm()) {
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
		if (validateAccountForm()) {
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

		if (first_name.trim() === "") {
			$("#firstNameError").text("First name should not be empty.");
			isValid = false;
		}

		if (last_name.trim() === "") {
			$("#lastNameError").text("Last name should not empty.");
			isValid = false;
		}

		return isValid;
	}


	function validateAccountForm() {
		var email = $("#email").val();
		var password = $("#password").val();
		var password_confirmation = $("#password_confirmation").val();

		$(".error-message").text("");

		var isValid = true;

		if (email.trim() === "") {
			$("#emailError").text("Email should not be empty.");
			isValid = false;
		}

		if (password !== password_confirmation) {
			$("#passwordConfirmError").text("Passwords do not match.");
			isValid = false;

			return isValid;
		}

	}
});
