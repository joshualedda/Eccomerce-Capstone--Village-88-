<div class="py-3 py-md-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="shopping-cart">
					<div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
						<div class="row">
							<div class="col-md-3">
								<h4>Products</h4>
							</div>
							<div class="col-md-2">
								<h4>Price</h4>
							</div>
							<div class="col-md-3">
								<h4>Quantity</h4>
							</div>
							<div class="col-md-2">
								<h4>Total Amount</h4>
							</div>
							<div class="col-md-2">
								<h4>Remove</h4>
							</div>
						</div>
					</div>


					<?php if (empty($carts)): ?>
						
						<div class="cart-item bg-light my-2">
								<div class="row align-items-center">
									<div class="col-md-4 my-auto">
									<p>No items in the cart.</p>
							</div>
						</div>
						</div>
					<?php else: ?>
						<?php foreach ($carts as $cart): ?>

							<div class="cart-item bg-light my-2">
								<div class="row align-items-center">
									<div class="col-md-3 my-auto">
										<a href="#">
										<img src="<?= base_url('assets/uploads/' . $cart['mainImage']) ?>" style="width: 50px; height: 50px;" alt="">
											<span class="product-name">
												<?= $cart['productName'] ?>
											</span>
										</a>
									</div>
									<div class="col-md-2 my-auto">
										<span class="price text-dark">
											<?= $cart['productId'] ?>
										</span>
									</div>
									<div class="col-md-3 col-7 my-auto">
										<div class="quantity">
											<div class="input-group">
												<span class="btn btn1 quantity-decrease"><i class="bi bi-dash"></i></span>
												<input type="text" value="1" class="input-quantity"
													id="quantityInput_<?= $cart['cartId'] ?>" />
												<!-- Use unique ID for each quantity input based on cartId -->
												<span class="btn btn1 quantity-increase"><i class="bi bi-plus"></i></span>
											</div>
										</div>
									</div>
									<div class="col-md-2 my-auto">
										<span class="price text-dark">Total </span>
									</div>
									<div class="col-md-2 col-5 my-auto">
										<div class="remove">
											<a href="#" id="createProduct" class="btn btn-danger btn-sm">
												<i class="bi bi-x"></i>
											</a>
										</div>
									</div>

								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>


<div class="col-md-4">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Multi Columns Form</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="inputName5">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword5">
                </div>
                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Address</label>
                  <input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">State</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div>
					<button type="submit" class="btn btn-primary">Procedd To CheckOut</button>

              </form>
            </div>
          </div>

        </div>

</div>











		</div>
	</div>
</div>
</div>
<script>
	$(document).ready(function () {
		// Increment quantity
		$('.quantity-increase').click(function () {
			var cartId = $(this).closest('.quantity').find('.input-quantity').attr('id').split('_')[1];
			var quantityInput = $('#quantityInput_' + cartId);
			var currentValue = parseInt(quantityInput.val());
			quantityInput.val(currentValue + 1);
			updateCartQuantity(cartId, quantityInput.val());
		});

		// Decrement quantity
		$('.quantity-decrease').click(function () {
			var cartId = $(this).closest('.quantity').find('.input-quantity').attr('id').split('_')[1];
			var quantityInput = $('#quantityInput_' + cartId);
			var currentValue = parseInt(quantityInput.val());
			if (currentValue > 1) {
				quantityInput.val(currentValue - 1);
				updateCartQuantity(cartId, quantityInput.val());
			}
		});

		// Function to update quantity via AJAX
		function updateCartQuantity(cartId, quantity) {
			$.ajax({
				type: 'POST',
				url: 'your_update_cart_quantity_url',
				data: { cart_id: cartId, quantity: quantity },
				success: function (response) {
					console.log('Quantity updated successfully');
					// Update total amount or perform other actions if needed
				},
				error: function (xhr, status, error) {
					console.error(error);
				}
			});
		}
	});

</script>
