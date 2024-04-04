<table class="table ">

	<tbody>
		<?php if (empty($categories)) : ?>
			<tr>
				<td colspan="4">No Data</td>
			</tr>
		<?php else : ?>

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


		<?php endif; ?>
	</tbody>
</table>
