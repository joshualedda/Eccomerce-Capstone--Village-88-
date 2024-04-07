<main class="main" id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Products</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Orders</li>
			</ol>
		</nav>
	</div>

	<div class="col-lg-12">

		<!-- Other filters here -->

		<div class="d-flex justify-content-end align-items-center my-2">
			<div class="search-bar me-2 col-md-4">

				<form method="POST" action="<?= base_url('product/search') ?>" id="filterProduct" class="search-form d-flex align-items-center">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					
				<select id="category" class="form-select " name="category">
						<option selected value="">Choose Below</option>
						<?php foreach ($categories as $category) : ?>
							<option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
						<?php endforeach; ?>
					</select>

					<input type="text" name="name" class="form-control mx-2" placeholder="Search" title="Enter search keyword">
				</form>



			</div>
			<a href="<?= base_url('product/create') ?>" class="btn btn-primary">Add Product</a>
		</div>


		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Products Data</h5>
				<div class="table-responsive">

					<table id="productsTable" class="table">
						<thead>
							<tr>
								<th scope="col">All Products <span class="fw-bold">98</span></th>
								<th scope="col">Product ID</th>
								<th scope="col">Price</th>
								<th scope="col">Category</th>
								<th scope="col">Stocks</th>
								<th scope="col">Sold</th>
								<th scope="col">Manage</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($products as $product) : ?>
								<tr>
									<td>
									<img style="width: 50px; height: 50px;" alt=""
										src="<?= base_url('assets/uploads/' . ($product['main_image_url'] ? $product['main_image_url'] : 'default-image.jpg')); ?>"
										alt="<?= $product['name']; ?>">

									<?= $product['name'] ?></td>
									<td><?= $product['productId'] ?></td>
									<td>$<?= number_format($product['price'], 2) ?></td>

									<td><?= $product['categoryName'] ?></td>
									<td><?= $product['stocks'] ?></td>
									<td><?= $product['total_sold'] ?? "0"?></td>
						
									<td>
										<a href="<?= base_url('products/view/' . $product['productId']) ?>" class="btn btn-sm btn-success mx-1">View</a>
										<a href="<?= base_url('products/edit/' . $product['productId']) ?>" class="btn btn-sm btn-success mx-1">Edit</a>
									</td>
								</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php if ($pagination['totalPages'] > 1): ?>
    <nav aria-label="Page navigation" class="my-2" id="pagination" >
        <ul class="pagination justify-content-center" >
            <?php if ($pagination['currentPage'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= base_url('products/index/?page=' . ($pagination['currentPage'] - 1)) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= ($pagination['currentPage'] == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('products/index/?page=' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= base_url('products/index/?page=' . ($pagination['currentPage'] + 1)) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

</main>

<script>
	$(document).ready(function() {
		$('#filterProduct input[name="name"], #filterProduct select[name="category"]').on('input change', function() {
			var formData = $('#filterProduct').serialize();
			$.ajax({
				type: 'POST',
				url: $('#filterProduct').attr('action'), 
				data: formData,
				success: function(response) {
					$('#productsTable tbody').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		});
	});
</script>

