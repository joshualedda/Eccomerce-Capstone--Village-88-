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

				<form method="POST" action="<?= base_url('orders/search') ?>" id="filterOrders" class="search-form d-flex align-items-center">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<select id="status" class="form-select " name="status">
					<option selected value="">Choose Below</option>
					<option value="0">Pending</option>
					<option value="1">In Process</option>
					<option value="2">Shipped</option>
					<option value="3">Delivered</option>
					<option value="4">Cancelled</option>
					<option value="5">Refund</option>
					</select>

					<input type="text" name="name" class="form-control mx-2" placeholder="Search" title="Enter search keyword">
				</form>

			</div>
		</div>


		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Orders Data</h5>
				<div class="table-responsive">

					<table class="table" id="ordersTable">
						<thead>
							<tr>
								<th scope="col">Product Name</th>
								<th scope="col">Order ID</th>
								<th scope="col">Order Date</th>
								<th scope="col">Receiver</th>
								<th scope="col">Total Item</th>
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
											<p class="text-sm"><?= $order['shipperAddress'] ?></p>
										</td>

										<td><?= $order['orderQuantity'] ?> Items</td>
										<td>$<?= $order['totalAmount'] ?></td>
										<td>
												<div class="col-md-10">
												<select class="form-select" aria-label="Default select example" onchange="updateOrderStatus(<?= $order['orderId'] ?>, this.value)">
														<option value="0" <?= ($order['status'] == 0) ? 'selected' : '' ?>>Pending</option>
														<option value="1" <?= ($order['status'] == 1) ? 'selected' : '' ?>>In Process</option>
														<option value="2" <?= ($order['status'] == 2) ? 'selected' : '' ?>>Shipped</option>
														<option value="3" <?= ($order['status'] == 3) ? 'selected' : '' ?>>Delivered</option>
														<option value="4" <?= ($order['status'] == 4) ? 'selected' : '' ?>>Cancelled</option>
														<option value="5" <?= ($order['status'] == 5) ? 'selected' : '' ?>>Refund</option>
													</select>

											</div>
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


<script>
	$(document).ready(function() {
		$('#filterOrders input[name="name"], #filterOrders select[name="status"]').on('input change', function() {
			var formData = $('#filterOrders').serialize();
			$.ajax({
				type: 'POST',
				url: $('#filterOrders').attr('action'), 
				data: formData,
				success: function(response) {
					$('#ordersTable tbody').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		});
	});
</script>

