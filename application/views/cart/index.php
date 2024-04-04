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
						<h5 class="card-title">Shipping Information</h5>

						<!-- Multi Columns Form -->
						<form class="row g-3">
							<div class="col-md-6">
								<label for="inputName5" class="form-label">First Name</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="inputEmail5" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="inputEmail5">
							</div>
							<div class="col-md-12">
								<label for="inputPassword5" class="form-label">Address 1</label>
								<input type="password" class="form-control" id="inputPassword5">
							</div>
							<div class="col-md-12">
								<label for="inputAddress5" class="form-label">Address 2</label>
								<input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St">
							</div>
							<div class="col-md-4">
								<label for="inputAddress2" class="form-label">City</label>
								<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
							</div>

							<div class="col-md-4">
								<label for="inputAddress2" class="form-label">State </label>
								<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
							</div>
							<div class="col-md-4">
								<label for="inputAddress2" class="form-label">Zip</label>
								<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
							</div>


							<div class="my-2 d-flex justify-content-between">
								<div>
									<p class="fw-bold">Order Summary</p>
									<p class="fw-bold">Items Summary</p>
									<p class="fw-bold">Shipping Fee</p>
									<p class="fw-bold">Total Amount</p>
								</div>
								<div>
									<p></p>
									<p class="fw-bold">$60</p>
									<p class="fw-bold">$5</p>
									<p class="fw-bold">$65</p>
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

