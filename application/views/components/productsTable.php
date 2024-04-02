<table  class="table ">

<tbody>
<?php if (empty($products)) : ?>
			<tr>
				<td colspan="4">No Data</td>
			</tr>
	<?php else : ?>
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
	<?php endif; ?>
</tbody>
</table>
