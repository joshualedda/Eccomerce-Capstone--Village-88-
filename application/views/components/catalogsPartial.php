
<?php if (empty($products)) : ?>
	<div class="col-md-12 text-center">
	<p>No Product Available</p>
</div>
	<?php else : ?>


				<?php foreach ($products as $product) : ?>
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
										<div>
											<span class="selling-price">$<?= $product['price'] ?></span>
										</div>
										<form class="addToCartForm" action="<?= base_url('catalogs/addToCart') ?>" method="POST">
											<div class="mt-2">
												<!-- CSRF token -->
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" class="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
												<input type="hidden" name="product_id" class="productId" value="<?= $product['productId'] ?>" />
												<input type="hidden" name="quantity" class="quantity" value="1" />
												<input type="submit" class="btn btn1 addToCartBtn" value="Add To Cart" />

												<a href="<?= base_url('product/view/' . $product['productId']) ?>" class="btn btn1"> View </a>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

	<?php endif; ?>
