	<!-- NAVBAR (3) -->
	<!-- TOP NAVBAR, WITH PHONE AND ADDRESS -->
	<nav class="navbar navbar-dark" style="height: 30px; background-color: #000000">
		<!-- address and phone -->
		<span class="navbar-text" style="padding: 0px 5px 5px 3px; font-size: 14px;">
			<span class="oi oi-home"></span> Jl. Cilacap, Indonesia 52302 
			<span class="oi oi-phone" style="margin-left: 20px;"></span> +62 88 8888 888
		</span>
		<!-- address and phone end -->
	</nav>

	<!-- MID NAVBAR, WITH WEB BRAND -->
	<nav class="navbar bg-white navbar-expand-lg navbar-light">
		<!-- brand -->
		<a class="navbar-brand" href="#">
			<img src="<?= base_url('/assets/images/favicon.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
			<?= $webname ?>
		</a>
		<!-- brand end -->

		<!-- account / cart -->
		<div class="d-none d-sm-none d-md-none d-lg-block d-xl-block ml-auto">
			<ul class="nav navbar-nav">
				<li class="nav-item">
					<?php if($loggedin): ?>
						<a class="nav-link" href="<?= base_url('Auth/logout/') ?>">Logout</a>
					<?php else: ?>
						<a class="nav-link" href="<?= base_url('login') ?>">Login</a>
					<?php endif; ?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('cart') ?>">My Cart: <?= $this->cart->total_items(); ?> Items</a>
				</li>
			</ul>
		</div>
		<!-- account / cart end -->

	</nav>

	<!-- BOT NAVBAR, WITH NAVIGATION -->
	<nav class="navbar navbar-dark navbar-expand-lg navbar-expand-md" style="background-color: #000000">
		<!-- search bar for smaller device -->
		<form class="form-inline d-inline d-sm-inline d-md-none">
			<input class="form-control" type="text" placeholder="Search" size="13">
			<button class="btn btn-primary" type="submit" style="font-size: 15px;">Search</button>
		</form>
		<!-- search bar for smaller device end -->

		<!-- responsive toggleable nav button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- responsive toggleable nav button end -->

		<!-- toggleable nav item -->
		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">

			<!-- left navigation -->
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url('') ?>">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('category') ?>">Shop</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('blog') ?>">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('about') ?>">About Us</a>
				</li>
				<?php if($loggedin): ?>
					<li>
						<a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
					</li>
				<?php endif; ?>
				<!-- <li class="nav-item d-block d-sm-block d-md-inline d-lg-none d-xl-none">
					CONDITION TO CHECK IF LOGGEDIN THEN SHOW ACCOUNT IF NOT THEN REGISTER
					<a class="nav-link" href="<?= base_url('account') ?>">Account</a>
				</li> -->
				<li class="nav-item d-block d-sm-block d-md-inline d-lg-none d-xl-none">
					<a class="nav-link" href="<?= base_url('cart') ?>">My Cart: <?= $this->cart->total_items(); ?> Items</a>
				</li>
			</ul>
			<!-- left navigation end -->


			<!-- right navigation -->
			<ul class="nav navbar-nav navbar-right">
				<li class="d-none d-sm-none d-md-block">
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="text" placeholder="Search" size="25">
						<button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
					</form>
				</li>
			</ul>
			<!-- right navigation end -->

		</div>
		<!-- toggleable nav item end -->
	</nav>
	<!-- NAVBAR END-->