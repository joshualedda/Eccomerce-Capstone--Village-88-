 <div class="main-navbar shadow-sm sticky-top py-2 bg-light">
 	<div class="top-navbar">
 		<div class="container">
 			<div class="row">
			 <div class="col-md-2 my-auto d-flex align-items-center justify-content-center">
				<h5 class="brand-name mb-0"><a href="<?= base_url('catalogs') ?>" class="text-decoration-none text-dark text-muted">VeggieCart</a></h5>
				<img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="img-fluid" style="max-width: 60px;">
			</div>
 				<div class="col-md-5 my-auto">

 				</div>

 				<!-- In devluponmetn -->
 				<?php if (isset($user_role) && $user_role == 1) : ?>
 					<li class="nav-item">
 						<a class="nav-link text-dark" href="#">
 							<i class="bi bi-heart-fill"></i> Dashboard (0)
 						</a>
 					</li>
 				<?php else : ?>

 				<?php endif; ?>

 				<?php if (isset($is_logged_in) && $is_logged_in) : ?>
 					<div class="col-md-5 my-auto">
 						<ul class="nav justify-content-end">


 							<li class="nav-item position-relative">
 								<a class="nav-link text-dark" href="<?=base_url('carts') ?>">
 									<i class="bi bi-cart"></i> Carts
									 <span id="cartTotal" class="position-absolute top-0 start-80 translate-middle badge rounded-pill bg-danger">
							<?= $cartsTotal ?>
							<span class="visually-hidden">unread messages</span>
						</span>

 								</a>
 							</li>


 							<li class="nav-item dropdown">
 								<a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 									<i class="bi bi-person-circle"></i>
 									<?= $user_data['first_name'] ?? '' ?> <?= $user_data['last_name'] ?? '' ?>
 								</a>
 								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
 									<li><a class="dropdown-item" href="<?= base_url('account/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
 									<li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
 									<li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
 									<li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
 									<li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
 								</ul>
 							</li>
 						</ul>
 					</div>
 				<?php else : ?>
 					<div class="col-md-5 my-auto">
 						<ul class="nav justify-content-end">

 							<li class="nav-item">
 								<a class="nav-link text-dark" href="<?= base_url('login') ?>">
 									Login
 								</a>
 							</li>
 							<li class="nav-item">
 								<a class="nav-link text-dark" href="<?= base_url('signup') ?>">
 									Register
 								</a>
 							</li>

 						</ul>
 					</div>
 				<?php endif; ?>
 			</div>
 		</div>
 	</div>
 </div>
