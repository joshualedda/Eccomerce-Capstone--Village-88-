$(document).ready(function () {
	$('.increase-quantity').click(function(e) {
        e.preventDefault();
        var quantityInput = $('#quantity');
        var currentQuantity = parseInt(quantityInput.val());
        quantityInput.val(currentQuantity + 1);
    });

    $('.decrease-quantity').click(function(e) {
        e.preventDefault();
        var quantityInput = $('#quantity');
        var currentQuantity = parseInt(quantityInput.val());
        if (currentQuantity > 1) {
            quantityInput.val(currentQuantity - 1);
        }
    });
	
	$(".addToCartForm").submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json", 
			success: function (response) {
				if (response.success) {
					updateCartTotal();
					$("#message").html(response.message);
					$("#liveToast").removeClass("hide");
					$(".toast").toast("show");
				} else {
					$("#message").html(response.message);
					$("#liveToast").removeClass("hide");
					$(".toast").toast("show");
				}
			},
			error: function (xhr, status, error) {
				console.error("Error adding product to cart. Please try againdsadas.");
			},
		});
	});

	function updateCartTotal() {
		$.ajax({
			type: "GET",
			url: "carts/getCartTotal",
			success: function (cartTotal) {
				$("#cartTotal").text(cartTotal);
			},
			error: function (xhr, status, error) {
				console.error(error);
			},
		});
	}

	//Search
	$('#filterCatalogs input[name="name"], #filterCatalogs select[name="category"], #filterCatalogs input[name="price_order"]'
	).on("input change", function () {
		var formData = $("#filterCatalogs").serialize();
		$.ajax({
			type: "POST",
			url: "catalog/search",
			data: formData,
			success: function (response) {
				$("#catalogData").html(response);
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});
});
