<!-- in development register -->


<section class="d-flex justify-content-center mt-5">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-dark">
				Register to order.
			</div>
			<div class="card-body">
				<form action="<?= base_url('signup') ?>" method="POST">

				<div class="mb-3">
						<label for="email" class="form-label">First Name</label>
						<input type="text" class="form-control" id="email" name="first_name">
						<?= form_error('first_name', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>


					<div class="mb-3">
						<label for="email" class="form-label">Last Name</label>
						<input type="text" class="form-control" id="email" name="last_name">
						<?= form_error('last_name', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>

					
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email">
						<?= form_error('email', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password">
						<?= form_error('password', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>	
					
					<div class="mb-3">
						<label for="password" class="form-label">Password Repeat</label>
						<input type="password" class="form-control" id="password" name="password_repeat">
						<?= form_error('password_repeat', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>	

					<div class="col-md-6 my-3">
						<input type="submit" name="submit" class="btn btn-primary" value="Register" />
					</div>
					<p>Already a member? <a class="text-decoration-none" href="<?= base_url('login') ?>">Login Here</a></p>
				</form>
			</div>
		</div>
	</div>
</section>
