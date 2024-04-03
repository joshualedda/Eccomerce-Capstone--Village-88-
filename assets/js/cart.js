$(document).ready(function() {
    $('.quantity-increase').click(function() {
        updateQuantity($(this), 1); 
    });

    $('.quantity-decrease').click(function() {
        updateQuantity($(this), -1);
    });

    // Update quantity function
    function updateQuantity(element, change) {
        const cartId = element.closest('.quantity').find('.input-quantity').attr('id').split('_')[1];
        const quantityInput = $('#quantityInput_' + cartId);
        let currentValue = parseInt(quantityInput.val());
        currentValue += change;
        if (currentValue < 1) {
            currentValue = 1; 
        }
        quantityInput.val(currentValue);
        updateCartQuantity(cartId, currentValue);
    }

	//Update Cart Quantity Function
    function updateCartQuantity(cartId, quantity) {
        $.ajax({
            type: 'POST',
            url: 'carts/updateQuantity',
            data: {
                cart_id: cartId,
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
				updateTotalAmount(cartId, quantity);
                console.log('Quantity updated successfully');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

	//update total amount function
	function updateTotalAmount(cartId, quantity) {
    const pricePerUnit = parseFloat($('#totalAmount_' + cartId).data('price')); 
    const totalAmountElement = $('#totalAmount_' + cartId);
    const newTotal = (pricePerUnit * quantity).toFixed(2); 
    totalAmountElement.text(newTotal); 
	}

    // Remove cart item function
    $(document).on('click', '#removeCart', function(e) {
        e.preventDefault();
        const cartId = $(this).closest('.cart-item').find('.input-quantity').attr('id').split('_')[1];
        const cartItem = $(this).closest('.cart-item'); 
        $.ajax({
            type: 'POST',
            url: 'carts/removeCartItem',
            data: {
                cart_id: cartId
            },
            dataType: 'json',
            success: function(response) {
                cartItem.remove();
                console.log('Item removed from cart');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
