<main class="main " id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Category Information</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Category View</li>
			</ol>
		</nav>
	</div>

	<div class=" d-flex justify-content-center">

		<div class="col-lg-12">
			<div class="text-end my-2">
				<a href="<?= base_url('category') ?>" class="btn btn-primary">Back</a>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Category Information </h5>

					<form class="row g-3" method="POST">

						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<div class="col-md-12">
							<label class="form-label">Category Name</label>
							<input disabled type="text" class="form-control" id="product" name="category" value="<?=$category['category']  ?>">
							<?= form_error('category', '<span  class="error text-sm text-danger">', '</span>'); ?>
							<span id="productError" class="text-sm text-danger error-message"></span>
						</div>

						<div class="col-md-12">
							<label class="form-label">Description</label>
							<textarea disabled id="description" name="description" class="form-control"><?=$category['description']  ?></textarea>
							<?= form_error('description', '<span id="productError" class="error text-sm text-danger">', '</span>'); ?>
							<span id="descriptionError" class="text-sm text-danger error-message"></span>
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
