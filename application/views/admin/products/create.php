<main class="main " id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Product Create</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Product New</li>
			</ol>
		</nav>
	</div>

	<div class=" d-flex justify-content-center">

		<div class="col-lg-12">
			<div class="text-end my-2">
				<a href="<?= base_url('products') ?>" class="btn btn-primary">Back</a>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Product Information</h5>

					<form id="createProduct" class="row g-3" action="<?= base_url('products/store') ?>" method="POST" enctype="multipart/form-data">

						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<div class="col-md-12">
							<label class="form-label">Product Name</label>
							<input type="text" class="form-control" id="product" name="product">
							<?= form_error('product', '<span  class="error text-sm text-danger">', '</span>'); ?>
							<span id="productError" class="text-sm text-danger error-message"></span>
						</div>
						<div class="col-md-12">

							<label class="form-label">Description</label>
							<textarea id="description" name="description" class="form-control"></textarea>
							<?= form_error('description', '<span id="productError" class="error text-sm text-danger">', '</span>'); ?>
							<span id="descriptionError" class="text-sm text-danger error-message"></span>


						</div>

						<div class="col-md-6">
							<label for="inputState" class="form-label">Category</label>
							<select id="category" class="form-select" name="category">
								<option selected value="">Choose Below</option>
								<?php foreach ($categories as $category) : ?>
									<option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('category', '<span class="error text-sm text-danger">', '</span>'); ?>
							<span id="categoryError" class="text-sm text-danger error-message"></span>

						</div>

						<div class="col-6">
							<label for="inputAddress2" class="form-label">Price</label>
							<input id="price" type="number" class="form-control" name="price">
							<?= form_error('price', '<span class="error text-sm text-danger">', '</span>'); ?>
							<span id="priceError" class="text-sm text-danger error-message"></span>

						</div>

						<div class="col-md-6">
							<label for="inputCity" class="form-label">Stocks</label>
							<input id="stocks" type="number" class="form-control" name="stocks">
							<?= form_error('stocks', '<span class="error text-sm text-danger">', '</span>'); ?>
							<span id="stocksError" class="text-sm text-danger error-message"></span>

						</div>

						<div class="col-md-6">
							<label for="inputCity" class="form-label">Upload Image (Max 5)</label>
							<input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
							<span id="imageValidate" class="text-sm text-danger"></span>
							<div id="imagePreview" class="mt-2"></div>
						</div>


						<div class="text-end">
							<input id="submitProduct" type="submit" name="submit" value="Add Product" class="btn btn-primary">
						</div>

					</form>

				</div>
			</div>

		</div>


	</div>

</main>
