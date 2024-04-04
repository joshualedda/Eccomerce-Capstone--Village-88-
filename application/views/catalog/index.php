<section class="container my-5">
	<div class="py-3 py-md-5">
		<div class="container">


			<div class="col-md">
				<h4 class="mb-4">All Products</h4>
			</div>
			<form method="POST" action="<?= base_url('product/search') ?>" id="filterCatalogs">
				<div class="d-flex justify-content-end align-items-center my-2">


					<div class="search-bar col-md-6">
						<div class="search-form d-flex align-items-center">

							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

							<select id="category" class="form-select " name="category">
								<option selected value="">All Product</option>
								<?php foreach ($categories as $category) : ?>
									<option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
								<?php endforeach; ?>
							</select>

							<input type="text" name="name" class="form-control mx-2" placeholder="Search" title="Enter search keyword">

						</div>
					</div>
				</div>


				<div class="row">

					<div class="col-md-2">



						<label for="" class="form-label">Price</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="price_order" id="highToLow" value="desc" checked>
							<label class="form-check-label" for="highToLow">
								High to low
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="price_order" id="lowToHigh" value="asc">
							<label class="form-check-label" for="lowToHigh">
								Low to high
							</label>
						</div>



			</form>
		</div>



		<div class="col-md-10">


			<div class="row" id="catalogData">

				<?php foreach ($products as $product) : ?>
					<div class="col-md-3">
						<div class="product-card">
							<div class="product-card-img">
								<label class="stock <?= $product['stocks'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
									<?= $product['stocks'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
								</label>
								<img src="<?= base_url('assets/uploads/' . ($product['main_image_url'] ? $product['main_image_url'] : 'default-image.jpg')); ?>" alt="<?= $product['name']; ?>">
							</div>
							<div class="product-card-body">
								<p class="product-brand">HP</p>
								<h5 class="product-name">
									<a href="<?= base_url('product/view/' . $product['productId']) ?>">
										<?= $product['name'] ?>
									</a>
								</h5>
								<div>
									<span class="selling-price">$<?= $product['price'] ?></span>
								</div>
								<form class="addToCartForm" action="<?= base_url('catalogs/addToCart') ?>" method="POST">
									<div class="mt-2">
										<!-- CSRF token -->
										<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" class="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
										<!-- Product ID and Quantity -->
										<input type="hidden" name="product_id" class="productId" value="<?= $product['productId'] ?>" />
										<input type="hidden" name="quantity" class="quantity" value="1" />
										<!-- Add To Cart button -->
										<input type="submit" class="btn btn1 addToCartBtn" value="Add To Cart" />

										<!-- Other buttons -->
										<a href="#" class="btn btn1"> <i class="bi bi-heart"></i> </a>
										<a href="<?= base_url('product/view/' . $product['productId']) ?>" class="btn btn1"> View </a>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

			</div>

		</div>
	</div>
	</div>
	</div>


</section>
