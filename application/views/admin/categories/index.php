<main class="main" id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Categories</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark"><a href="<?=base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Categories</li>
			</ol>
		</nav>
	</div>

	<div class="col-lg-12">

	<div class="d-flex justify-content-end align-items-center my-2">
			<div class="search-bar me-2 col-md-3">

				<form method="POST" action="<?= base_url('product/search') ?>" id="filterProduct" class="search-form d-flex align-items-center">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					
					<input type="text" name="name" class="form-control mx-2" placeholder="Search" title="Enter search keyword">
				</form>



			</div>
			<a href="<?= base_url('product/create') ?>" class="btn btn-primary">Add Category</a>
		</div>



		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Categores Details</h5>
				<div class="table-responsive">

					<table class="table">
						<thead>
							<tr>
								<th scope="col">Category Name</th>
								<th scope="col">Created At</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Brandon Jacob</td>
						
							
								<td>28</td>
								<td>2016-05-25</td>
							</tr>
							
						
						</tbody>
					</table>
				</div>
			</div>
		</div>






</main>
