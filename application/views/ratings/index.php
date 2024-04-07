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

					<form   action="<?= base_url('catalogs/addToCart') ?>" method="POST">
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

		<h5 class="mt-5 mb-4">Please leave your reviews here.</h5>



	
				<div class="row">
					<div class="col-md-12" id="ratingsReviews">

						<?php if ($ratings) : ?>
							<div>
								Rating: <?= $ratings['rating'] ?>
								<input disabled class="star star-5" id="star-5" type="radio" name="rating" value="5" <?php if ($ratings['rating'] == 5) : ?> checked <?php endif; ?> />
								<label class="star star-5" for="star-5"></label>

								<input disabled class="star star-4" id="star-4" type="radio" name="rating" value="4" <?php if ($ratings['rating'] == 4) : ?> checked <?php endif; ?> />
								<label class="star star-4" for="star-4"></label>

								<input disabled class="star star-3" id="star-3" type="radio" name="rating" value="3" <?php if ($ratings['rating'] == 3) : ?> checked <?php endif; ?> />
								<label class="star star-3" for="star-3"></label>

								<input disabled class="star star-2" id="star-2" type="radio" name="rating" value="2" <?php if ($ratings['rating'] == 2) : ?> checked <?php endif; ?> />
								<label class="star star-2" for="star-2"></label>

								<input disabled class="star star-1" id="star-1" type="radio" name="rating" value="1" <?php if ($ratings['rating'] == 1) : ?> checked <?php endif; ?> />
								<label class="star star-1" for="star-1"></label>
							</div>
							<div class="form-group">
								<textarea disabled class="form-control" rows="3" placeholder="Enter your reply here"><?= $ratings['comment'] ?></textarea>
							</div>



					</div>

				</div>
			</div>
		<?php else : ?>

			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p><strong><?= $user['name']  ?></strong></p>
							<form id="rateProductForm" action="<?= base_url('ratings/rate/' . $product['id']) ?>" method="POST">
								<div>


									<input class="star star-5" id="star-5" type="radio" name="rating" value="5" />

									<label class="star star-5" for="star-5"></label>

									<input class="star star-4" id="star-4" type="radio" name="rating" value="4" />

									<label class="star star-4" for="star-4"></label>

									<input class="star star-3" id="star-3" type="radio" name="rating" value="3" />

									<label class="star star-3" for="star-3"></label>

									<input class="star star-2" id="star-2" type="radio" name="rating" value="2" />

									<label class="star star-2" for="star-2"></label>

									<input class="star star-1" id="star-1" type="radio" name="rating" value="1" />

									<label class="star star-1" for="star-1"></label>
								</div>
						<span class="error text-sm text-danger"><?= form_error('rating') ?></span> 

								<div class="form-group">
									<textarea name="comment" class="form-control" rows="3" placeholder="Enter your reply here"></textarea>
						<span class="error text-sm text-danger"><?= form_error('comment') ?></span> 
							
								</div>
								<div class="text-end my-2">
									<input type="submit" class="btn btn-success" value="Reply" />
								</div>
						</div>

						</form>

					</div>

				</div>
			</div>
		<?php endif; ?>

		</div>
	</div>

