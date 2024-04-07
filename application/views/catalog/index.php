<section class="container my-5">
	<div class="py-3 py-md-5">
		<div class="container">


			<div class="col-md">
				<h4 class="mb-4">All Products</h4>
			</div>
			<form method="POST" action="<?= base_url('catalog/search') ?>" id="filterCatalogs">
				<div class="d-flex justify-content-end align-items-center my-2">


					<div class="search-bar col-md-6">
						<div class="search-form d-flex align-items-center">

							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
								value="<?= $this->security->get_csrf_hash(); ?>">

							<select id="category" class="form-select " name="category">
								<option selected value="">All Product</option>
								<?php foreach ($categories as $category): ?>
									<option value="<?= $category['id']; ?>">
										<?= $category['category']; ?>
									</option>
								<?php endforeach; ?>
							</select>

							<input type="text" name="name" class="form-control mx-2" placeholder="Search"
								title="Enter search keyword">
						</div>
					</div>
				</div>


				<div class="row">

					<div class="col-md-2">



						<label for="" class="form-label">Price</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="price_order" id="highToLow" value="desc"
								checked>
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

				<?php foreach ($products as $product): ?>
					<div class="col-md-3">
						<div class="product-card">
							<div class="product-card-img">
								<label class="stock <?= $product['stocks'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
									<?= $product['stocks'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
								</label>
								<div class="d-flex justify-content-center"> 
									<img class="w-75"
										src="<?= base_url('assets/uploads/' . ($product['main_image_url'] ? $product['main_image_url'] : 'default-image.jpg')); ?>"
										alt="<?= $product['name']; ?>">
								</div>
							</div>
							<div class="product-card-body">

								<p class="product-brand">
									<?= $product['categoryName'] ?>
								</p>
								<h5 class="product-name">
									<a href="<?= base_url('product/view/' . $product['productId']) ?>">
										<?= $product['name'] ?>
									</a>
								</h5>
								<p class="product-brand">Ratings:
									<?= $product['averageRating'] ?>
								</p>
								<div>
									<span class="selling-price">$
										<?= number_format($product['price'], 2) ?>
									</span>

								</div>
								<form class="addToCartForm" action="<?= base_url('catalogs/addToCart') ?>" method="POST">
									<div class="mt-2">
										<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
											class="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
										<input type="hidden" name="product_id" class="productId"
											value="<?= $product['productId'] ?>" />
										<input type="hidden" name="quantity" class="quantity" value="1" />
										<input type="submit" class="btn btn1 addToCartBtn" value="Add To Cart" />

										<a href="<?= base_url('product/view/' . $product['productId']) ?>" class="btn btn1">
											View </a>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

			</div>



			<?php if ($pagination['totalPages'] > 1): ?>
				<nav aria-label="Page navigation" class="my-2" id="pagination">
					<ul class="pagination justify-content-center">
						<?php if ($pagination['currentPage'] > 1): ?>
							<li class="page-item">
								<a class="page-link"
									href="<?= base_url('catalogs/?page=' . ($pagination['currentPage'] - 1)) ?>"
									aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="visually-hidden">Previous</span>
								</a>
							</li>
						<?php endif; ?>
						<?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
							<li class="page-item <?= ($pagination['currentPage'] == $i) ? 'active' : '' ?>">
								<a class="page-link" href="<?= base_url('catalogs/?page=' . $i) ?>">
									<?= $i ?>
								</a>
							</li>
						<?php endfor; ?>
						<?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
							<li class="page-item">
								<a class="page-link"
									href="<?= base_url('catalogs/?page=' . ($pagination['currentPage'] + 1)) ?>"
									aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="visually-hidden">Next</span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</nav>
			<?php endif; ?>

		</div>
	</div>
	</div>
	</div>


</section>