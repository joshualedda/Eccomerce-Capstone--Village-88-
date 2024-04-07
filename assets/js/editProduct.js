$(document).ready(function () {
	$("#imagePreviewContainer").on("click", ".remove-image", function () {
		var $removeBtn = $(this);
		var imageId = $removeBtn.data("image");

		$.ajax({
			type: "POST",
			url: baseUrl + "products/deleteImage/" + imageId,
			success: function (response) {
				$("#message").html("Removed Successfully");
				$("#liveToast").removeClass("hide");
				$(".toast").toast("show");
				$removeBtn.closest(".image-container").remove();
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});

	$("#imagePreviewContainer").on("change", ".set-main-image", function () {
		var $checkbox = $(this);

		if ($checkbox.is(":checked")) {
			$(".set-main-image").not($checkbox).prop("checked", false);
		}

		var imageId = $checkbox.val();
		var mainStatus = $checkbox.is(":checked") ? 1 : 0;
		$.ajax({
			type: "POST",
			url: baseUrl + "products/updateMainImage/" + imageId,
			data: { main_status: mainStatus },
			success: function (response) {
				console.log("Main image status updated successfully");
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});

	//update product
	$("#updateProduct").submit(function (e) {
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: $(this).attr("action"),
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				$("#message").html("Product Updatedd Successfully");
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
	});
});
