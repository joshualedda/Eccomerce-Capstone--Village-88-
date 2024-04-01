<main class="main" id="main">
<div class="pagetitle">
		<h1 class="text-dark">Products</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark"><a href="<?=base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Orders</li>
			</ol>
		</nav>
	</div>

	<div class="col-lg-12">

	<!-- Other filters here -->

	<div class="d-flex justify-content-end align-items-center my-2">
    <div class="search-bar me-2 col-md-3">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" class="form-control" placeholder="Search" title="Enter search keyword">
        </form>
    </div>
    <a href="<?=base_url('product/create')?>" class="btn btn-primary">Add Product</a>
</div>


		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Products Data</h5>
				<div class="table-responsive">

					<table class="table">
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
								<td><?=$product['name'] ?></td>
								<td><?=$product['productId'] ?></td>
								<td><?=$product['price'] ?></td>
								<td><?=$product['category'] ?></td>
								<td><?=$product['stocks'] ?></td>
								<td></td>
								<td>
									<a href="<?=base_url('products/view/' . $product['productId'] )?>" class="btn btn-sm btn-success mx-1">View</a>
									<a href="<?=base_url('products/edit/' . $product['productId'] )?>" class="btn btn-sm btn-success mx-1">Edit</a>
								</td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>






</main>


