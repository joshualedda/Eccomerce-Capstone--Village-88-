<main id="main" class="main">
	<div class="pagetitle">
		<h1 class="text-dark">Orders</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark"><a href="<?= base_url('catalogs') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Track Order</li>
			</ol>
		</nav>
	</div>

	<div class=" justify-content-center">
		<div class="col-md-10">
			<div class="card ">
				<div class="card-body">
					<h5 class="card-title">Track Orders</h5>

					<ul class="nav nav-tabs nav-tabs-bordered" id="borderedTabJustified" role="tablist">
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tab-home" 
							type="button" role="tab" aria-controls="home" aria-selected="true">Pending</button>
						</li>
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tab-profile" 
							type="button" role="tab" aria-controls="profile" aria-selected="false">Processing</button>
						</li>
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#tab-shipped" type="button" role="tab" aria-controls="contact" aria-selected="false">Shipped</button>
						</li>
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100" id="deliveredTab" data-bs-toggle="tab" data-bs-target="#tab-delivered" type="button" role="tab" aria-controls="deliveredTab" aria-selected="false">Delivered</button>
						</li>
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100" id="cancelledTab" data-bs-toggle="tab" data-bs-target="#tab-cancelled" type="button" role="tab" aria-controls="cancelledTab" aria-selected="false">Cancelled</button>
						</li>
						<li class="nav-item flex-fill" role="presentation">
							<button class="nav-link w-100" id="refundTab" data-bs-toggle="tab" data-bs-target="#tab-refund" type="button" role="tab" aria-controls="refundTab" aria-selected="false">Refund</button>
						</li>
					</ul>

					<div class="tab-content pt-2" id="borderedTabJustifiedContent">
						<div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
							<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($pendings)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($pendings as $pending) : ?>
											<tr>
												<td><?= $pending['orderCreated'] ?></td>
												<td>$<?= $pending['total_amount'] ?></td>
											<td><?= (new DateTime($pending['orderCreated']))->format('F j, Y') ?></td>

											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
						<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($process)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($process as $proc) : ?>
											<tr>
												<td><?= $proc['productName'] ?></td>
												<td>$<?= $proc['total_amount'] ?></td>
													<td><?= (new DateTime($proc['created_at']))->format('F j, Y') ?></td>

											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab-shipped" role="tabpanel" aria-labelledby="contact-tab">
						<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($shipped)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($shipped as $ship) : ?>
											<tr>
												<td><?= $ship['productName'] ?></td>
												<td>$<?= $ship['total_amount'] ?></td>
											<td><?= (new DateTime($ship['created_at']))->format('F j, Y') ?></td>

											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab-delivered" role="tabpanel" aria-labelledby="deliveredTab">
						<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
										<th scope="col">Manage</th>

									</tr>
								</thead>
								<tbody>
									<?php if (empty($delivered)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($delivered as $del) : ?>
											<tr>
												<td><?= $del['productName'] ?></td>
												<td>$<?= $del['total_amount'] ?></td>
											<td><?= (new DateTime($del['created_at']))->format('F j, Y') ?></td>
												<td><a href="<?=base_url('rate/product/' .$del['productId']) ?>" class="btn btn-success btn-sm">Rate</a></td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab-cancelled" role="tabpanel" aria-labelledby="cancelledTab">
						<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($cancelled)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($cancelled as $cancel) : ?>
											<tr>
												<td><?= $cancel['productName'] ?></td>
												<td>$<?= $cancel['total_amount'] ?></td>
												<td><?= (new DateTime($cancel['created_at']))->format('F j, Y') ?></td>

											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab-refund" role="tabpanel" aria-labelledby="refundTab">
						<table id="productsTable" class="table my-2 text-center">
								<thead>
									<tr>
										<th scope="col">Product Name</th>
										<th scope="col">Total Amount</th>
										<th scope="col">Order Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($refunds)) : ?>
										<tr>
											<td colspan="4">No Orders</td>
										</tr>
									<?php else : ?>

										<?php
										foreach ($refunds as $refund) : ?>
											<tr>
												<td><?= $refund['productName'] ?></td>
												<td>$<?= $refund['total_amount'] ?></td>
											<td><?= (new DateTime($refund['created_at']))->format('F j, Y') ?></td>

											</tr>
										<?php endforeach; ?>
									<?php endif; ?>


								</tbody>
							</table>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

</main>
