<table class="table ">

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
