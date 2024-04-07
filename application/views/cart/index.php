<div class="py-3 py-md-5">
	<div class="container">
		<div class="row">

			<div class="col-md-<?php echo isset($is_logged_in) && $is_logged_in ? '8' : '12'; ?>">

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
									<?php if (isset($is_logged_in) && $is_logged_in): ?>
										<p>No items in the cart.</p>
									<?php else: ?>
										<p>Login to show the items.</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?php foreach ($carts as $cart): ?>
							<div class="cart-item bg-light my-2">
								<div class="row align-items-center">
									<div class="col-md-3 my-auto">
										<a href="#">
											<img src="<?= base_url('assets/uploads/' . $cart['mainImage']) ?>"
												style="width: 50px; height: 50px;" alt="">
											<span class="product-name">
												<?= $cart['productName'] ?>
											</span>
										</a>
									</div>


									<div class="col-md-2 my-auto">
										<span class="price text-dark" data-price="<?= $cart['productPrice'] ?>">
											<?= $cart['productPrice'] ?>
										</span>
									</div>

									<div class="col-md-3 col-7 my-auto">
										<div class="quantity">
											<div class="input-group">
												<span class="btn btn1 quantity-decrease"><i class="fa fa-minus"></i></span>
												<input type="text" value="<?= $cart['totalQuantity'] ?>" class="input-quantity"
													id="quantityInput_<?= $cart['cartId'] ?>" />
												<span class="btn btn1 quantity-increase"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>

									<div class="col-md-2 my-auto">
										<span id="totalPrice_<?= $cart['cartId'] ?>" data-price="<?= $cart['productPrice'] ?>">
											Total: $
											<?= $cart['totalPrice'] ?>
										</span>
									</div>



									<div class="col-md-2 col-5 my-auto">
										<form action="carts/removeCartItem" method="POST">

											<div class="remove">
												<input type="hidden" value="<?= $cart['cartId'] ?>" name="cart_id">
												<input type="submit" id="removeCart" class="btn btn-danger btn-sm"
													value="Remove" />
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					<?php endif; ?>
				</div>
			</div>


			<?php if (isset($is_logged_in) && $is_logged_in): ?>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<h6 class="card-title">Shipping Information</h6>
							<form id="paymentForm" action="<?= base_url('orders/createOrder') ?>" method="POST"
								class="row g-3">
								<div class="col-md-12">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="sameBillingCheckbox"
											name="checkbox">
										<label class="form-check-label" for="sameBillingCheckbox">Same in billing</label>
									</div>
								</div>

								<div class="row g-3" id="shippingForm">

									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">First Name</label>
										<input type="text" class="form-control" id="firstNameShipping"
											name="firstNameShipping">
										<span class="text-sm text-danger" id="firstNameShipValid"></span>
									</div>
									<div class="col-md-12">
										<label for="inputLastName" class="form-label">Last Name</label>
										<input type="text" class="form-control" id="lastNameShipping"
											name="lastNameShipping">
										<span class="text-sm text-danger" id="lastNameShippingValid"></span>
									</div>
									<div class="col-md-12">
										<label for="inputPassword5" class="form-label">Address 1</label>
										<input type="text" class="form-control" id="address1Shipping"
											name="address1Shipping">
										<span class="text-sm text-danger" id="address1ShippingValid"></span>

									</div>
									<div class="col-md-12">
										<label for="inputAddress5" class="form-label">Address 2</label>
										<input type="text" class="form-control" id="address2Shipping"
											name="address2Shipping">
										<span class="text-sm text-danger" id="address2ShippingValid"></span>

									</div>
									<div class="col-md-4">
										<label for="inputAddress2" class="form-label">City</label>
										<input type="text" class="form-control" id="cityShipping" name="cityShipping">
										<span class="text-sm text-danger" id="cityShippingValid"></span>

									</div>

									<div class="col-md-4">
										<label for="inputAddress2" class="form-label">State </label>
										<input type="text" class="form-control" id="stateShipping" name="stateShipping">
										<span class="text-sm text-danger" id="stateShippingValid"></span>

									</div>
									<div class="col-md-4">
										<label for="inputAddress2" class="form-label">Zip</label>
										<input type="text" class="form-control" id="zipShipping" name="zipShipping">
										<span class="text-sm text-danger" id="zipShippingValid"></span>

									</div>
								</div>

								<div class="row g-3" id="billingForm">
									<h6 class="card-title">Billing Information</h6>

									<div class="col-md-6">
										<label for="inputFirstName" class="form-label">First Name</label>
										<input type="text" class="form-control" id="firstNameBilling"
											name="firstNameBilling">
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
										<p class="fw-bold">Shipping Fee</p>
										<p class="fw-bold">Total Amount</p>
									</div>
									<div>
										<p>&nbsp;</p>
										<p id="totalItemAmountCart" class="fw-bold">$
											<?= !empty($totalItemAmount) ? $totalItemAmount : '0.00' ?>
										</p>
										<p class="fw-bold">$20</p>
										<p id="totalItemAmountSummayyy" class="fw-bold">$
											<?= !empty($totalCartAmount) ? $totalCartAmount : '0.00' ?>
										</p>
									</div>
								</div>
								<!-- Modal -->

								<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
									aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"
													aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label for="card_name" class="form-label">Card Name</label>
													<input type="text" class="form-control" id="card_name" name="card_name">
													<span class="text-sm text-danger" id="cardNameValid"></span>
												</div>
												<div class="mb-3">
													<label for="card_number" class="form-label">Card Number</label>
													<input type="text" class="form-control" id="card_number"
														name="card_number">
													<span class="text-sm text-danger" id="cardNumValid"></span>

												</div>
												<div class="row">
													<div class="col-md-6 mb-3">
														<label for="expiration" class="form-label">Expiration
															Date</label>
														<input type="month" class="form-control" id="expiration"
															name="expiration">
														<span class="text-sm text-danger" id="expData"></span>

													</div>
													<div class="col-md-6 mb-3">
														<label for="cvc" class="form-label">CVC</label>
														<input type="text" class="form-control" id="cvc" name="cvc">
														<span class="text-sm text-danger" id="cvcValid"></span>

													</div>
												</div>
												<h5>Total Amount: <span>$
														<?= $cart['totalPrice'] ?? "0" ?>
													</span></h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary"
													data-bs-dismiss="modal">Close</button>
												<input type="submit" class="btn btn-primary" value="Pay" />
											</div>
										</div>
									</div>
								</div>


								<?php if (empty($carts)): ?>
									<button type="button" class="btn btn-success" data-bs-toggle="modal"
										data-bs-target="#exampleModal" disabled>
										Process To Checkout
									</button>
								<?php else: ?>
									<button id="checkoutBtn" type="button" class="btn btn-success" data-bs-toggle="modal"
										data-bs-target="#exampleModal">
										Process To Checkout
									</button>
								<?php endif; ?>



							</form>



						</div>
					</div>

				</div>


			<?php else: ?>
			<?php endif; ?>



		</div>



	</div>
</div>
</div>
</div>

<script>

</script>
<script>
	$(document).ready(function () {
		function validateShippingInfo() {
			var firstNameShipping = $('#firstNameShipping').val().trim();
			var lastNameShipping = $('#lastNameShipping').val().trim();
			var address1Shipping = $('#address1Shipping').val().trim();
			var cityShipping = $('#cityShipping').val().trim();
			var stateShipping = $('#stateShipping').val().trim();
			var zipShipping = $('#zipShipping').val().trim();

			var isValid = true;

			if (firstNameShipping === '') {
				$('#firstNameShipValid').show().text('First name is required.');
				isValid = false;
			} else {
				$('#firstNameShipValid').hide().text('');
			}

			if (lastNameShipping === '') {
				$('#lastNameShippingValid').show().text('Last name is required.');
				isValid = false;
			} else {
				$('#lastNameShippingValid').hide().text('');
			}

			if (address1Shipping === '') {
				$('#address1ShippingValid').show().text('Address 1 is required.');
				isValid = false;
			} else {
				$('#address1ShippingValid').hide().text('');
			}

			if (cityShipping === '') {
				$('#cityShippingValid').show().text('City is required.');
				isValid = false;
			} else {
				$('#cityShippingValid').hide().text('');
			}

			if (stateShipping === '') {
				$('#stateShippingValid').show().text('State is required.');
				isValid = false;
			} else {
				$('#stateShippingValid').hide().text('');
			}

			if (zipShipping === '') {
				$('#zipShippingValid').show().text('ZIP code is required.');
				isValid = false;
			} else {
				$('#zipShippingValid').hide().text('');
			}

			return isValid;
		}

		function updateCheckoutButton() {
			var isValid = validateShippingInfo();
			$('#checkoutBtn').prop('disabled', !isValid);
		}


		$('#firstNameShipping, #lastNameShipping, #address1Shipping, #cityShipping, #stateShipping, #zipShipping').on('input', function () {
			validateShippingInfo();
			updateCheckoutButton();
		});

		$('#paymentForm').submit(function (event) {
			event.preventDefault();

			var isValid = validateShippingInfo();

			if (isValid) {
				$('#exampleModal').modal('hide');
				this.submit();
			}
		});
	});
</script>