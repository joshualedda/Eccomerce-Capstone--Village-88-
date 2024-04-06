<div class="py-3 py-md-5">
	<div class="container">
		<div class="row">
			<div class="col-md-5 mt-3">
				<div class="bg-white border">
					<?php if (!empty($image) && isset($image['main_image_url'])) : ?>
						<img src="<?= base_url('assets/uploads/' . $image['main_image_url']); ?>" alt="<?= $product['name']; ?>" class="img-fluid">
					<?php else : ?>
						<p>No main image available</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-7 mt-3">
				<div class="product-view">
					<h4 class="product-name">
						<?= $product['name'] ?>

						<label class="label-stock <?= $product['stocks'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
							<?= $product['stocks'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
						</label>

					</h4>
					<hr>
					<p class="product-path">
						Catalogs / Product / <?= $product['name'] ?>
					</p>
					<div>
						<span class="selling-price">$ <?= $product['price'] ?></span>
					</div>

					<form class="addToCartForm" action="<?= base_url('catalogs/addToCart') ?>" method="POST">
						<div class="mt-2">
							<div class="input-group">
								<span class="btn btn1 decrease-quantity"><i class="fa fa-minus"></i></span>
								<input name="quantity" type="text" value="1" class="input-quantity" id="quantity" />
								<span class="btn btn1 increase-quantity"><i class="fa fa-plus"></i></span>
							</div>

						</div>

						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<input type="hidden" name="product_id" value="<?= $product['id'] ?>" />
						<div class="mt-2">
							<input type="submit" class="btn btn1 addToCartBtn" value="Add To Cart" />
							<a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
						</div>
					</form>



					<div class="mt-3">
						<h5 class="mb-0">Description</h5>
						<p>
							<?= $product['description'] ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<h4 class="mt-5 mb-4">Reviews</h4>

		<?php if ($ratings) : ?>	
			<?php foreach ($ratings as $rating) : ?>

			<div>
				<input disabled class="star star-5" id="star-5" type="radio" name="rating" value="5" <?php if ($rating['rating'] == 5) : ?> checked <?php endif; ?> />
				<label class="star star-5" for="star-5"></label>

				<input disabled class="star star-4" id="star-4" type="radio" name="rating" value="4" <?php if ($rating['rating'] == 4) : ?> checked <?php endif; ?> />
				<label class="star star-4" for="star-4"></label>

				<input disabled class="star star-3" id="star-3" type="radio" name="rating" value="3" <?php if ($rating['rating'] == 3) : ?> checked <?php endif; ?> />
				<label class="star star-3" for="star-3"></label>

				<input disabled class="star star-2" id="star-2" type="radio" name="rating" value="2" <?php if ($rating['rating'] == 2) : ?> checked <?php endif; ?> />
				<label class="star star-2" for="star-2"></label>

				<input disabled class="star star-1" id="star-1" type="radio" name="rating" value="1" <?php if ($rating['rating'] == 1) : ?> checked <?php endif; ?> />
				<label class="star star-1" for="star-1"></label>
			</div>
			<div class="form-group">
				<label for="" class="form-label">Joshua Ledda</label>
				<textarea disabled class="form-control" rows="3"><?= $rating['comment'] ?></textarea>
			</div>
			<?php endforeach; ?>
		<?php endif; ?>


		<div class="row">
			<h4 class="mt-5 mb-4">Similar Products</h4>
			<?php
			foreach ($items as $item) : ?>
				<div class="col-md-3 ">
					<div class="product-card">
						<div class="product-card-img">
							<label class="stock <?= $item['stocks'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
								<?= $item['stocks'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
							</label>
							<img src="<?= base_url('assets/uploads/' . ($item['main_image_url'] ? $item['main_image_url'] : 'default-image.jpg')); ?>" alt="<?= $item['name']; ?>">

						</div>
						<div class="product-card-body">
							<p class="product-brand">MI</p>
							<h5 class="product-name">
								<a href="<?= base_url('product/view/' . $item['productId']) ?>">
									<?= $item['name'] ?>
								</a>
							</h5>
							<div>
								<span class="selling-price">$<?= $item['price'] ?></span>
							</div>

							<form class="addToCartForm" action="<?= base_url('catalogs/addToCart') ?>" method="POST">
								<div class="mt-2">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" class="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
									<input type="hidden" name="product_id" class="productId" value="<?= $item['productId'] ?>" />
									<input type="hidden" name="quantity" class="quantity" value="1" />
									<input type="submit" class="btn btn1 addToCartBtn" value="Add To Cart" />

									<a href="#" class="btn btn1"> <i class="fa fa-heart" aria-hidden="true"></i> </a>
									<a href="<?= base_url('product/view/' . $item['productId']) ?>" class="btn btn1"> View </a>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach; ?>




		</div>
	</div>
</div>
