<main class="main" id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Categories</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Categories</li>
			</ol>
		</nav>
	</div>

	<div class="col-lg-12">

		<div class="d-flex justify-content-end align-items-center my-2">
			<div class="search-bar me-2 col-md-3">

				<form id="filterCatalogs" method="POST" action="<?= base_url('category/search') ?>" class="search-form d-flex align-items-center">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<input type="text" name="name" class="form-control mx-2" placeholder="Search" title="Enter search keyword">
				</form>



			</div>
			<a href="<?= base_url('category/create') ?>" class="btn btn-primary">Add Category</a>
		</div>



		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Categores Details</h5>
				<div class="table-responsive">

					<table class="table" id="categoriesData">
						<thead>
							<tr>
								<th scope="col">Category Name</th>
								<th scope="col">Created At</th>
								<th scope="col">Manage</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($categories as $category) : ?>
								<tr>
									<td><?= $category['category'] ?></td>
									<td><?= (new DateTime($category['created_at']))->format('F j, Y') ?></td>

									<td>
										<a href="<?= base_url('categories/view/' . $category['id']) ?>" class="btn btn-sm btn-success mx-1">View</a>
										<a href="<?= base_url('categories/edit/' . $category['id']) ?>" class="btn btn-sm btn-success mx-1">Edit</a>
									</td>
								</tr>
							<?php endforeach; ?>


						</tbody>
					</table>
				</div>
			</div>
		</div>


</main>
<script>
	$(document).ready(function() {
		$('#filterCatalogs input[name="name"]').on('input change', function() {
			var formData = $('#filterCatalogs').serialize();
			$.ajax({
				url: $('#filterCatalogs').attr('action'), 
				type: 'POST',
				data: formData,
				success: function(response) {
					$('#categoriesData tbody').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		});
	});
</script>
