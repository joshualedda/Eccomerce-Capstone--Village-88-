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


					<?php if (empty($carts)) : ?>

						<div class="cart-item bg-light my-2">
							<div class="row align-items-center">
								<div class="col-md-4 my-auto">
									<p>No items in the cart.</p>
								</div>
							</div>
						</div>
					<?php else : ?>
						<?php foreach ($carts as $cart) : ?>
							<div class="cart-item bg-light my-2">
								<div class="row align-items-center">
									<div class="col-md-3 my-auto">
										<a href="#">
											<img src="<?= base_url('assets/uploads/' . $cart['mainImage']) ?>" style="width: 50px; height: 50px;" alt="">
											<span class="product-name"><?= $cart['productName'] ?></span>
										</a>
									</div>
									<div class="col-md-2 my-auto">
										<span class="price text-dark"><?= $cart['productPrice'] ?></span>
									</div>

									<div class="col-md-3 col-7 my-auto">
								<div class="quantity">
									<div class="input-group">
										<span class="btn btn1 quantity-decrease"><i class="bi bi-dash"></i></span>
										<input type="text" value="<?= $cart['totalQuantity'] ?>" class="input-quantity" id="quantityInput_<?= $cart['cartId'] ?>" />
										<span class="btn btn1 quantity-increase"><i class="bi bi-plus"></i></span>
									</div>
								</div>
							</div>

							<div class="col-md-2 my-auto">
								Total: $<span id="totalAmount_<?= $cart['cartId'] ?>" class="price text-dark" data-price="<?= $cart['totalPrice'] ?>" data-cartid="<?= $cart['cartId'] ?>"><?= $cart['totalPrice'] ?></span>
							</div>


									<div class="col-md-2 col-5 my-auto">
										<div class="remove">
											<a href="#" id="removeCart" class="btn btn-danger btn-sm">
												Remove
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
						<h6 class="card-title">Shipping Information</h6>
							<form action="<?=base_url('orders/createOrder') ?>" method="POST" class="row g-3">
								<div class="col-md-12">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="sameBillingCheckbox" name="checkbox">
										<label class="form-check-label" for="sameBillingCheckbox">Same in billing</label>
									</div>
								</div>

								<div class="row g-3" id="shippingForm">
									
								<div class="col-md-12">
									<label for="inputFirstName" class="form-label">First Name</label>
									<input type="text" class="form-control" id="firstNameShipping" name="firstNameShipping">
								</div>
								<div class="col-md-12">
									<label for="inputLastName" class="form-label">Last Name</label>
									<input type="text" class="form-control" id="lastNameShipping" name="lastNameShipping">
								</div>
								<div class="col-md-12">
									<label for="inputPassword5" class="form-label">Address 1</label>
									<input type="text" class="form-control" id="address1Shipping" name="address1Shipping">
								</div>
								<div class="col-md-12">
									<label for="inputAddress5" class="form-label">Address 2</label>
									<input type="text" class="form-control" id="address2Shipping" name="address2Shipping">
								</div>
								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">City</label>
									<input type="text" class="form-control" id="cityShipping" name="cityShipping">
								</div>

								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">State </label>
									<input type="text" class="form-control" id="stateShipping" name="stateShipping">
								</div>
								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">Zip</label>
									<input type="text" class="form-control" id="zipShipping" name="zipShipping">
								</div>
								</div>

							<div class="row g-3" id="billingForm">
								<h6 class="card-title">Billing Information</h6>

								<div class="col-md-6">
									<label for="inputFirstName" class="form-label">First Name</label>
									<input type="text" class="form-control" id="firstNameBilling" name="firstNameBilling">
								</div>
								<div class="col-md-6">
									<label for="inputLastName" class="form-label">Last Name</label>
									<input type="text" class="form-control" id="lastNameBilling" name="lastNameBilling">
								</div>
								<div class="col-md-12">
									<label for="inputPassword5" class="form-label">Address 1</label>
									<input type="text" class="form-control" id="address1Billing" name="address1Billing">
								</div>
								<div class="col-md-12">
									<label for="inputAddress5" class="form-label">Address 2</label>
									<input type="text" class="form-control" id="address2Billing" name="address2Billing">
								</div>
								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">City</label>
									<input type="text" class="form-control" id="cityBilling" name="cityBilling">
								</div>

								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">State </label>
									<input type="text" class="form-control" id="stateBilling" name="stateBilling">
								</div>
								<div class="col-md-4">
									<label for="inputAddress2" class="form-label">Zip</label>
									<input type="text" class="form-control" id="zipBilling" name="zipBilling">
								</div>
							</div>

								<div class="my-2 d-flex justify-content-between">
									<div>
										<p class="fw-bold">Order Summary</p>
										<p class="fw-bold">Items</p>
										<p class="fw-bold">Total Amount</p>
									</div>
									<div>
										<p>&nbsp;</p>
										<p id="totalItemAmount" class="fw-bold">$<?= !empty($totalCartAmount) ? $totalCartAmount : '0.00' ?></p>

										<p id="totalItemAmount" class="fw-bold">$<?= !empty($totalCartAmount) ? $totalCartAmount : '0.00' ?></p>
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
	$(document).ready(function() {
    if ($('#sameBillingCheckbox').is(':checked')) {
        $('#billingForm').hide();
    }

    $('#sameBillingCheckbox').on('change', function() {
        if ($(this).is(':checked')) {
            $('#billingForm').hide(); 
        } else {
            $('#billingForm').show(); 
        }
    });

});

</script>
