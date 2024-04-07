<?php if ($ratings): ?>
	<?php foreach ($ratings as $rating): ?>









		<?php if (isset($rating['replies']) && !empty($rating['replies'])): ?>
			<?php foreach ($rating['replies'] as $reply): ?>
				<div class="form-group mx-5">
					<h6 class="my-2">Replies</h6>
					<label for="reply" class="form-label">
						<?= $reply['UserName'] ?? " " ?> | <span>
							<?= date('F j, Y H:i:s', strtotime($reply['replyCreated'])) ?>
						</span>
					</label>
					<textarea disabled class="form-control" rows="3"><?= $reply['replyComment'] ?></textarea>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="card-body">
			</div>
		<?php endif; ?>




	<?php endforeach; ?>
<?php else: ?>
	<div class="my-3 text-center">
		No reviews to the product yet.
	</div>
<?php endif; ?>