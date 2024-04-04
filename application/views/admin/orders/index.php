<main class="main" id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Orders</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Orders</li>
			</ol>
		</nav>
	</div>

	<div class="col-lg-12">

	
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
				<h5 class="card-title">Orders Data</h5>
				<div class="table-responsive">

					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product Name</th>
								<th scope="col">Order ID</th>
								<th scope="col">Order Date</th>
								<th scope="col">Receiver</th>
								<th scope="col">Total Amount</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($orders)) : ?>
								<tr>
									<td colspan="4">No Data</td>
								</tr>
							<?php else : ?>
								<?php foreach ($orders as $order) : ?>
									<tr>
										<td><?= $order['productName'] ?></td>
										<td><?= $order['orderId'] ?></td>
										<td><?= (new DateTime($order['orderDate']))->format('F j, Y') ?></td>

										<td>
											<p><?= $order['shipperName'] ?></p>
											<p  class="text-sm"><?= $order['shipperAddress'] ?></p>
											</td>
										<td>Sample</td>
										<td>
											<a href="<?= base_url('products/view/' . $order['productId']) ?>" class="btn btn-sm btn-success mx-1">View</a>
											<a href="<?= base_url('products/edit/' . $order['productId']) ?>" class="btn btn-sm btn-success mx-1">Edit</a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>


						</tbody>
					</table>
				</div>
			</div>
		</div>






</main>
