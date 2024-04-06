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
    <a class="nav-link d-flex justify-content-between align-items-center <?php echo ($this->uri->segment(1) == 'profile' || $this->uri->segment(1) == 'users') ? '' : 'collapsed'; ?>" 
	data-bs-target="#forms-navs" data-bs-toggle="collapse" href="<?= base_url('profile') ?>">
        <span>
		<i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <span>User Settings</span>
        </span>
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
    </a>
    <ul id="forms-navs" class="nav-content collapse <?php echo ($this->uri->segment(1) == 'profile' || $this->uri->segment(1) == 'users') ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
        <li class="py-2">
            <a href="<?= base_url('profile') ?>" class="text-decoration-none">
                <i class="bi bi-circle"></i><span>Profile</span>
            </a>
        </li>
        <li class="py-2">
            <a href="<?= base_url('users') ?>" class="text-decoration-none">
                <i class="bi bi-circle"></i><span>Users</span>
            </a>
        </li>
    </ul>
</li>



		<li class="nav-item">
			<a class="nav-link collapsed" href="pages-login.html">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
				<span>Sign Out</span>
			</a>
		</li>



	</ul>

</aside>
