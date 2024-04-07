<aside id="sidebar" class="sidebar">


	<ul class="sidebar-nav" id="sidebar-nav">

		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? '' : 'collapsed'; ?>" href="<?= base_url('dashboard') ?>">
			<i class="fa fa-pie-chart" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'orders') ? '' : 'collapsed'; ?>" href="<?= base_url('orders') ?>">
			<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				<span>Orders</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'products') ? '' : 'collapsed'; ?>" href="<?= base_url('products') ?>">
			<i class="fa fa-file-text" aria-hidden="true"></i>
				<span>Product</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'category') ? '' : 'collapsed'; ?>" href="<?= base_url('category') ?>">
			<i class="fa fa-bars" aria-hidden="true"></i>
				<span>Categories</span>
			</a>
		</li>




		<li class="nav-heading">Other Components</li>


<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'profile') ? '' : 'collapsed'; ?>" href="<?= base_url('profile') ?>">
			<i class="fa fa-user-circle-o" aria-hidden="true"></i>
				<span>Profile</span>
			</a>
		</li>


		<li class="nav-item">
			<a class="nav-link collapsed" href="<?= base_url('logout') ?>">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
				<span>Sign Out</span>
			</a>
		</li>



	</ul>

</aside>
