<!-- in development -->


<section class="d-flex justify-content-center mt-5">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-dark">
				Login to order.
			</div>
			<div class="card-body">
				<form action="<?= base_url('login/process') ?>" method="POST">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="text" class="form-control" id="email" name="email" >
						<!-- Validation -->
						<?= form_error('email', '<span class="error text-sm text-danger">', '</span>'); ?>
						<?= isset($error_message) ? '<div class="error text-sm text-danger">' . $error_message . '</div>' : '' ?>
				
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" >
						<?= form_error('password', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>		
					<div class="col-md-6 my-3">
						<input type="submit" name="submit" class="btn btn-primary" value="Login" />
					</div>
					<p>New Member? <a class="text-decoration-none" href="<?= base_url('signup') ?>">Register Here</a></p>
				</form>
			</div>
		</div>
	</div>
</section>
