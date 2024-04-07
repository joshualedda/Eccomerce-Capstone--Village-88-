<table class="table ">

	<tbody>
		<?php if (empty($products)): ?>
			<tr>
				<td colspan="4">No Data</td>
			</tr>
		<?php else: ?>
			
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
		<?php endif; ?>
	</tbody>
</table>