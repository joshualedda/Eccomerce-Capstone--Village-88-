<section class="container my-5">
	<div class="py-3 py-md-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h4 class="mb-4">All Products</h4>
				</div>

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
									<span class="selling-price">₱<?= $product['price'] ?></span>
								</div>
								<form action="<?=base_url('catalogs/addToCart') ?>" method="POST">
									<div class="mt-2">
										<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
										<input type="hidden" name="product_id" value="<?=$product['productId'] ?>"/>
										<input type="hidden" name="quantity" value="1"/>
										<input type="submit" class="btn btn1" value="Add To Cart"/>
										<a href="" class="btn btn1"> <i class="bi bi-heart"></i> </a>
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



</section>


<style>

</style>
