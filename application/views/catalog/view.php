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
						<?=$product['name'] ?>

						<label class="label-stock <?= $product['stocks'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
                    	<?= $product['stocks'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
                		</label>

					</h4>
					<hr>
					<p class="product-path">
						Catalogs / Product / <?=$product['name'] ?>
					</p>
					<div>
						<span class="selling-price">$ <?=$product['price'] ?></span>
						<!-- <span class="original-price">$499</span> -->
					</div>
					<div class="mt-2">
						<div class="input-group">
							<span class="btn btn1"><i class="fa fa-minus"></i></span>
							<input type="text" value="1" class="input-quantity" />
							<span class="btn btn1"><i class="fa fa-plus"></i></span>
						</div>
					</div>

					<form action="<?=base_url('catalogs/addToCart') ?>" method="POST">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<input type="hidden" name="product_id" value="<?=$product['id'] ?>"/>
					<div class="mt-2">
						<input type="submit" class="btn btn1" value="Add To Cart"/>
						<a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
					</div>
					</form>

					<div class="mt-3">
						<h5 class="mb-0">Description</h5>
						<p>
						<?=$product['description'] ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h4 class="mt-5 mb-4">Similar Products</h4>
			<div class="col-md-3 ">

				<div class="product-card">
					<div class="product-card-img">
						<label class="stock bg-success">In Stock</label>
						<img src="mobile-redmi-note-8.jpg" alt="Red MI Note 8">
					</div>
					<div class="product-card-body">
						<p class="product-brand">MI</p>
						<h5 class="product-name">
							<a href="">
								Red MI Note 8
							</a>
						</h5>
						<div>
							<span class="selling-price">$200</span>
							<span class="original-price">$300</span>
						</div>
						
						<div class="mt-2">
							<a href="" class="btn btn1">Add To Cart</a>
							<a href="" class="btn btn1"> <i class="bi bi-heart"></i> </a>
							<a href="" class="btn btn1"> View </a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-card">
					<div class="product-card-img">
						<label class="stock bg-success">In Stock</label>
						<img src="mobile-redmi-note-8.jpg" alt="Red MI Note 8">
					</div>
					<div class="product-card-body">
						<p class="product-brand">MI</p>
						<h5 class="product-name">
							<a href="">
								Red MI Note 8
							</a>
						</h5>
						<div>
							<span class="selling-price">$200</span>
							<span class="original-price">$300</span>
						</div>
						<div class="mt-2">
							<a href="" class="btn btn1">Add To Cart</a>
							<a href="" class="btn btn1"> <i class="bi bi-heart"></i> </a>
							<a href="" class="btn btn1"> View </a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="product-card">
					<div class="product-card-img">
						<label class="stock bg-success">In Stock</label>
						<img src="mobile-redmi-note-8.jpg" alt="Red MI Note 8">
					</div>
					<div class="product-card-body">
						<p class="product-brand">MI</p>
						<h5 class="product-name">
							<a href="">
								Red MI Note 8
							</a>
						</h5>
						<div>
							<span class="selling-price">$200</span>
							<span class="original-price">$300</span>
						</div>
						<div class="mt-2">
							<a href="" class="btn btn1">Add To Cart</a>
							<a href="" class="btn btn1"> <i class="bi bi-heart"></i> </a>
							<a href="" class="btn btn1"> View </a>
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-3">
				<div class="product-card">
					<div class="product-card-img">
						<label class="stock bg-success">In Stock</label>
						<img src="mobile-redmi-note-8.jpg" alt="Red MI Note 8">
					</div>
					<div class="product-card-body">
						<p class="product-brand">MI</p>
						<h5 class="product-name">
							<a href="">
								Red MI Note 8
							</a>
						</h5>
						<div>
							<span class="selling-price">$200</span>
							<span class="original-price">$300</span>
						</div>
						<div class="mt-2">
							<a href="" class="btn btn1">Add To Cart</a>
							<a href="" class="btn btn1"> <i class="bi bi-heart"></i> </a>
							<a href="" class="btn btn1"> View </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
