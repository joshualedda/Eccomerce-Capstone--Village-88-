$(document).ready(function () {
	$(".quantity-increase").click(function () {
		updateQuantity($(this), 1);
	});

	$(".quantity-decrease").click(function () {
		updateQuantity($(this), -1);
	});

	//Update Cart Quantity Function
	function updateCartQuantity(cartId, quantity) {
		$.ajax({
			type: "POST",
			url: "carts/updateQuantity",
			data: {
				cart_id: cartId,
				quantity: quantity,
			},
			dataType: "json",
			success: function (response) {
				updateTotalPrice(cartId);
				console.log(updateTotalPrice());
				console.log("Quantity updated successfully");
			},
			error: function (xhr, status, error) {
				console.error(error);
				console.log("Error");
				console.error("Error:", xhr.responseText);
			},
		});
	}

	// Update quantity function
	function updateQuantity(element, change) {
		const cartId = element
			.closest(".quantity")
			.find(".input-quantity")
			.attr("id")
			.split("_")[1];
		const quantityInput = $("#quantityInput_" + cartId);
		let currentValue = parseInt(quantityInput.val());
		currentValue += change;
		if (currentValue < 1) {
			currentValue = 1;
		}
		quantityInput.val(currentValue);
		updateCartQuantity(cartId, currentValue);
	}

	// Update total price function
	function updateTotalPrice(cartId) {
		const totalElement = $("#totalPrice_" + cartId);
		const pricePerUnit = parseFloat(totalElement.attr("data-price"));
		const quantity = parseInt($("#quantityInput_" + cartId).val());

		if (!isNaN(pricePerUnit) && !isNaN(quantity)) {
			const newTotal = (pricePerUnit * quantity).toFixed(2);
			totalElement.text("Total: $" + newTotal);
		} else {
			console.error("Invalid price or quantity:", pricePerUnit, quantity);
		}
	}

	// Remove cart item function
	$(document).on("click", "#removeCart", function (e) {
		e.preventDefault();
		const cartId = $(this)
			.closest(".cart-item")
			.find(".input-quantity")
			.attr("id")
			.split("_")[1];
		const cartItem = $(this).closest(".cart-item");
		$.ajax({
			type: "POST",
			url: "carts/removeCartItem",
			data: {
				cart_id: cartId,
			},
			dataType: "json",
			success: function (response) {
				cartItem.remove();
				console.log("Item removed from cart");
			},
			error: function (xhr, status, error) {
				console.error(error);
			},
		});
	});
});
