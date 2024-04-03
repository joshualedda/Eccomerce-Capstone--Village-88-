$(document).ready(function() {
	$('.addToCartForm').submit(function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				updateCartTotal();
				$("#message").html("Added To Cart.");
				$("#liveToast").removeClass("hide");
				$(".toast").toast("show");
			},
			error: function(xhr, status, error) {
				console.error(error);
				alert('Error adding product to cart. Please try again.');
			}
		});
	});

	function updateCartTotal() {
		$.ajax({
			type: 'GET',
			url: 'carts/getCartTotal',
			success: function(cartTotal) {
				$('#cartTotal').text(cartTotal);
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	}

	//Search
	$('#filterCatalogs input[name="name"], #filterCatalogs select[name="category"], #filterCatalogs input[name="price_order"]').on('input change', function() {
		var formData = $('#filterCatalogs').serialize();
		$.ajax({
			type: 'POST',
			url: 'catalog/search',
			data: formData,
			success: function(response) {
				$('#catalogData').html(response);
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});
	});
});
