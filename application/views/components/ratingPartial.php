<?php if ($ratings): ?>
	<div>
		Rating:
		<?= $ratings['rating'] ?>
		<input disabled class="star star-5" id="star-5" type="radio" name="rating" value="5" <?php if ($ratings['rating'] == 5): ?> checked <?php endif; ?> />
		<label class="star star-5" for="star-5"></label>

		<input disabled class="star star-4" id="star-4" type="radio" name="rating" value="4" <?php if ($ratings['rating'] == 4): ?> checked <?php endif; ?> />
		<label class="star star-4" for="star-4"></label>

		<input disabled class="star star-3" id="star-3" type="radio" name="rating" value="3" <?php if ($ratings['rating'] == 3): ?> checked <?php endif; ?> />
		<label class="star star-3" for="star-3"></label>

		<input disabled class="star star-2" id="star-2" type="radio" name="rating" value="2" <?php if ($ratings['rating'] == 2): ?> checked <?php endif; ?> />
		<label class="star star-2" for="star-2"></label>

		<input disabled class="star star-1" id="star-1" type="radio" name="rating" value="1" <?php if ($ratings['rating'] == 1): ?> checked <?php endif; ?> />
		<label class="star star-1" for="star-1"></label>
	</div>
	<div class="form-group">
		<textarea disabled class="form-control" rows="3"
			placeholder="Enter your reply here"><?= $ratings['comment'] ?></textarea>
	</div>
	</div>

	</div>
	</div>

<?php endif; ?>
