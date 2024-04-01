<main class="main" id="main">
	<div class="pagetitle">
		<h1 class="text-dark">Profile</h1>
		<nav class="my-2">
			<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark"><a href="<?=base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
				<li class="breadcrumb-item active text-dark">Orders</li>
			</ol>
		</nav>
	</div>

	<div class=" d-flex justify-content-start">

		<div class="col-lg-5">

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Personal Information</h5>

					<form class="row g-3">
						<div class="col-12">
							<label for="inputNanme4" class="form-label">First Name</label>
							<input type="text" class="form-control" id="inputNanme4">
						</div>
						<div class="col-12">
							<label for="inputEmail4" class="form-label">Last Name</label>
							<input type="email" class="form-control" id="inputEmail4">
						</div>
						<div class="col-12">
							<label for="inputPassword4" class="form-label">Email</label>
							<input type="password" class="form-control" id="inputPassword4">
						</div>
						
						<div class="text-end">
							<input type="submit" class="btn btn-success" value="Update"/>
						</div>
					</form>

				</div>
			</div>
		</div>








		<div class="col-lg-5 mx-5">

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Account Information</h5>

					<form class="row g-3">
						<div class="col-12">
							<label for="inputNanme4" class="form-label">Email</label>
							<input type="text" class="form-control" id="inputNanme4">
						</div>
						<div class="col-12">
							<label for="inputEmail4" class="form-label">Password</label>
							<input type="password" class="form-control" id="inputPassword4">
						</div>
						<div class="col-12">
							<label for="inputPassword4" class="form-label">Repeat Password</label>
							<input type="password" class="form-control" id="inputPassword4">
						</div>
				
							
						<div class="text-end">
							<input type="submit" class="btn btn-success" value="Update"/>
						</div>
					</form>

				</div>
			</div>
		</div>





	</div>







</main>
