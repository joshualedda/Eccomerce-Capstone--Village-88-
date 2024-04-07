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

});
