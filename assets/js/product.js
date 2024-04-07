//product add
$(document).ready(function () {
	$(document).ready(function () {
		$("#images").change(function () {
			var files = $(this)[0].files;
			if (files.length > 5) {
				$("#imageValidate").text("Maximum 5 images allowed.");
				$(this).val("");
				$("#imagePreview").empty();
			} else {
				$("#imageValidate").text("");
				$("#imagePreview").empty();
				var imageRow = $('<div class="row"></div>'); 
				for (var i = 0; i < files.length; i++) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var imageDiv = $(
							'<div class="col-md-4 mb-2"><img src="' +
								e.target.result +
								'" class="img-thumbnail" width="100"></div>'
						);
						var checkboxDiv = $(
							'<div class="col-md-2 mb-2"><input class="form-check-input main-image-checkbox" type="checkbox" name="main_image[]" value="' +
								e.target.result +
								'"><label class="form-check-label">Main</label></div>'
						);
						var deleteButtonDiv = $(
							'<div class="col-md-2 mb-2"><button type="button" class="btn btn-danger btn-sm delete-image">Remove</button></div>'
						);
						var imageContainer = $('<div class="col-md-4"></div>');
						imageContainer.append(imageDiv);
						imageContainer.append(checkboxDiv);
						imageContainer.append(deleteButtonDiv);
						imageRow.append(imageContainer);
					};
					reader.readAsDataURL(files[i]);
				}
				$("#imagePreview").append(imageRow);
			}
		});

		$("#imagePreview").on("click", ".delete-image", function () {
			$(this).closest(".col-md-4").remove(); 
		});

		$(document).on("change", ".main-image-checkbox", function () {
			$(".main-image-checkbox").not(this).prop("checked", false);
		});
	});

	$("#createProduct").submit(function (e) {
		e.preventDefault();
		if (validateForm()) {
			var formData = new FormData(this);
			$.ajax({
				url: $(this).attr("action"),
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					$("#message").html("Product Created Successfully");
					$("#liveToast").removeClass("hide");
					$(".toast").toast("show");
					$("#createProduct")[0].reset();
					$(".error-message").text("");
					$("#imagePreview").empty();
				},
				error: function (xhr, status, error) {
					console.error(xhr.responseText);
				},
			});
		}
	});

	function validateForm() {
		var product = $("#product").val().trim();
		var description = $("#description").val().trim();
		var category = $("#category").val().trim();
		var price = $("#price").val().trim();
		var stocks = $("#stocks").val().trim();
		var files = $("#images")[0].files;
		var mainImagesChecked = $(".main-image-checkbox:checked").length;
		var isValid = true;

		$(".error-message").text("");

		if (product === "") {
			$("#productError").text("Please enter a product name.");
			isValid = false;
		}

		if (description === "") {
			$("#descriptionError").text("Please enter a description.");
			isValid = false;
		}

		if (category === "") {
			$("#categoryError").text("Please select a category.");
			isValid = false;
		}

		if (price === "") {
			$("#priceError").text("Price is required.");
			isValid = false;
		} else if (isNaN(price) || parseFloat(price) <= 0) {
			$("#priceError").text("Price must be a valid positive number.");
			isValid = false;
		}

		if (stocks === "") {
			$("#stocksError").text("Stocks are required.");
			isValid = false;
		} else if (isNaN(stocks) || parseInt(stocks) <= 0) {
			$("#stocksError").text("Stocks must be a valid positive integer.");
			isValid = false;
		}

		if (files.length === 0) {
			$("#imageValidate").text("Please upload at least 1 image.");
			isValid = false;
		} else {
			for (var i = 0; i < files.length; i++) {
				var fileType = files[i].type;
				if (!fileType.startsWith("image/")) {
					$("#imageValidate").text("Only image files are allowed.");
					isValid = false;
					break;
				}
			}
		}

		if (mainImagesChecked === 0) {
			$("#imageCheck").text("Please mark at least one image as main.");
			isValid = false;
		}

		return isValid;
	}

	//Product Edit




});
