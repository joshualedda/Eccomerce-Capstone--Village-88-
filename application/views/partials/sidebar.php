<aside id="sidebar" class="sidebar">

	<ul class="sidebar-nav" id="sidebar-nav">

		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? '' : 'collapsed'; ?>" href="<?= base_url('dashboard') ?>">
			<i class="bi bi-bar-chart-line"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'orders') ? '' : 'collapsed'; ?>" href="<?= base_url('orders') ?>">
			<i class="bi bi-card-checklist"></i>
				<span>Orders</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'products') ? '' : 'collapsed'; ?>" href="<?= base_url('products') ?>">
			<i class="bi bi-clipboard"></i>
				<span>Product</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'category') ? '' : 'collapsed'; ?>" href="<?= base_url('category') ?>">
			<i class="bi bi-list"></i>
				<span>Categories</span>
			</a>
		</li>




		<li class="nav-heading">Other Components</li>
		<li class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center <?php echo ($this->uri->segment(1) == 'profile' || $this->uri->segment(1) == 'users') ? '' : 'collapsed'; ?>" 
	data-bs-target="#forms-navs" data-bs-toggle="collapse" href="<?= base_url('profile') ?>">
        <span>
            <i class="bi bi-person-circle"></i>
            <span>User Settings</span>
        </span>
        <i class="bi bi-chevron-down"></i>
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
				<i class="bi bi-box-arrow-in-left"></i>
				<span>Sign Out</span>
			</a>
		</li>



	</ul>

</aside>
