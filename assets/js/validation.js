//product add
$(document).ready(function () {
	$("#images").change(function () {
		var files = $(this)[0].files;
		if (files.length > 5) {
			$("#imageValidate").text("Maximum 5 images allowed.");
			$(this).val(''); // Clear the file input
			$("#imagePreview").empty(); // Clear the preview
		} else {
			$("#imageValidate").text(""); // Clear validation message
			$("#imagePreview").empty(); // Clear previous previews
			for (var i = 0; i < files.length; i++) {
				var reader = new FileReader();
				reader.onload = function (e) {
					var container = $('<div class="image-container"></div>');
					var imageDiv = $('<div class="mb-2"><div class="col-md-12"><img src="' + e.target.result + '" class="img-thumbnail" width="100"></div></div>');
					var deleteButton = $('<div class="col-md-1"><button type="button" class="btn btn-danger btn-sm delete-image">X</button></div>');
					var checkboxDiv = $('<div class="col-md-3"><input class="form-check-input main-image-checkbox" type="checkbox" name="main_image[]" value="' + e.target.result + '"><label class="form-check-label">Mark as Main</label></div>');
					container.append(imageDiv);
					container.append(checkboxDiv); // Append checkbox
					container.append(deleteButton);
					$("#imagePreview").append(container);
				};
				reader.readAsDataURL(files[i]);
			}
		}
	});
	
    $(document).on('click', '.delete-image', function () {
        $(this).closest('.image-container').remove();
    });
	
	

    // Handle main image checkbox change
    $(document).on('change', '.main-image-checkbox', function () {
        // Uncheck other checkboxes
        $('.main-image-checkbox').not(this).prop('checked', false);
    });

	 $("#createProduct").submit(function (e) {
        e.preventDefault();
        if (validateForm()) {
            var formData = new FormData(this); // Create FormData object from the form
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type automatically
                success: function (response) {
                    $("#message").html("Product Successfully Added.");
                    $("#liveToast").removeClass("hide");
                    $(".toast").toast("show");
                    $("#createProduct")[0].reset();
                    $(".error-message").text("");
                    $("#imagePreview").empty(); // Clear preview after successful submission
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        }
    });

	function validateForm() {
		var product = $("#product").val();
		var description = $("#description").val();
		var category = $("#category").val();
		var price = $("#price").val();
		var stocks = $("#stocks").val();
		var isValid = true;

		$(".error-message").text("");

		if (product.trim() === "") {
			$("#productError").text("Please enter a product name.");
			isValid = false;
		}

		if (description.trim() === "") {
			$("#descriptionError").text("Please enter a description.");
			isValid = false;
		}

		if (category.trim() === "") {
			$("#categoryError").text("Please select a category.");
			isValid = false;
		}

		if (price.trim() === "") {
			$("#priceError").text("Price is required.");
			isValid = false;
		} else if (isNaN(price)) {
			$("#priceError").text("Price must be valid.");
			isValid = false;
		}

		if (stocks.trim() === "") {
			$("#stocksError").text("Stocks must be valid.");
			isValid = false;
		} else if (isNaN(stocks)) {
			$("#stocksError").text("Stocks must be a valid number.");
			isValid = false;
		}

		return isValid;
	}
});
