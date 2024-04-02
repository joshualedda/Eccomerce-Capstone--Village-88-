<nav class="navbar navbar-expand-lg navbar-light">
	<div class="container">
		<button class="navbar-toggler sidebar-toggler" type="button" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="d-flex justify-content-end flex-grow-1">
			<div class="nav-item dropdown">
				<a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="bi bi-person-circle"></i>
					<?= $user_data['first_name'] ?? '' ?> <?= $user_data['last_name'] ?? 'dsas' ?>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="<?= base_url('account/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
					<li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
					<li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
					<li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
					<li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
