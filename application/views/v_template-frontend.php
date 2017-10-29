<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Tittle -->
	<title><?= $title ?></title>

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('/assets/images/favicon.png') ?>">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/template.css') ?>">
	<!-- Iconic CSS -->
	<link href="<?= base_url('assets/open-iconic-master/font/css/open-iconic-bootstrap.css') ?>" rel="stylesheet">
	<!-- FontAwesome CSS -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

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
					<a class="nav-link" href="<?= base_url('register') ?>">Register</a>
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
				<li class="nav-item d-block d-sm-block d-md-inline d-lg-none d-xl-none">
					<!-- CONDITION TO CHECK IF LOGGEDIN THEN SHOW ACCOUNT IF NOT THEN REGISTER -->
					<a class="nav-link" href="<?= base_url('account') ?>">Account</a>
				</li>
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




	<!-- PAGE CONTENT -->
	<?php $this->load->view($content); ?>
	<!-- PAGE CONTENT END -->



	<!-- FOOTER WIDGET -->
	<footer class="footer1">
		<div class="container">

			<div class="row"><!-- row -->

				<div class="col-lg-3 col-md-3"><!-- widgets column left -->
					<ul class="list-unstyled clear-margins"><!-- widgets -->

						<li class="widget-container widget_nav_menu"><!-- widgets list -->

							<h1 class="title-widget">Service</h1>

							<ul>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Online Help</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Contact Us</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Order Status</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Change Location</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> FAQ</a></li>
							</ul>

						</li>

					</ul>


				</div><!-- widgets column left end -->



				<div class="col-lg-3 col-md-3"><!-- widgets column left -->

					<ul class="list-unstyled clear-margins"><!-- widgets -->

						<li class="widget-container widget_nav_menu"><!-- widgets list -->

							<h1 class="title-widget">Quick Shop</h1>

							<ul>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12; "></span> T-Shirt</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Mens</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Womens</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Shoes</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Gift Cards	</a></li>

							</ul>

						</li>

					</ul>


				</div><!-- widgets column left end -->



				<div class="col-lg-3 col-md-3"><!-- widgets column left -->

					<ul class="list-unstyled clear-margins"><!-- widgets -->

						<li class="widget-container widget_nav_menu"><!-- widgets list -->

							<h1 class="title-widget">Policies</h1>

							<ul>


								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Term of Use</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Privacy Policy</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Refund Policy</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Billing System</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span>  Ticket System</a></li>

							</ul>

						</li>



					</ul>


				</div><!-- widgets column left end -->


				<div class="col-lg-3 col-md-3"><!-- widgets column center -->


					<ul class="list-unstyled clear-margins"><!-- widgets -->

						<!-- <li class="widget-container widget_nav_menu">

							<h1 class="title-widget">About</h1>

							<ul>


								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Company Information</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Careers</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Store Location</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Affiliate Program</a></li>
								<li><a  href="#"><span class="oi oi-chevron-right" style="color: #f39c12;"></span> Copyright</a></li>

							</ul>

						</li>
						<br> -->
						<h3 class="title-median" style="color: #8d949b;">Follow Us</h4>	
							<div class="social-icons">

								<ul class="nomargin">

									<a href="https://www.facebook.com/bootsnipp"><i class="fa fa-facebook-square fa-3x social-fb" id="social"></i></a>
									<a href="https://twitter.com/bootsnipp"><i class="fa fa-twitter-square fa-3x social-tw" id="social"></i></a>
									<a href="https://plus.google.com/+Bootsnipp-page"><i class="fa fa-google-plus-square fa-3x social-gp" id="social"></i></a>
									<a href="mailto:bootsnipp@gmail.com"><i class="fa fa-envelope-square fa-3x social-em" id="social"></i></a>

								</ul>
							</div>

							<br>
							<h3 class="title-median" style="color: #8d949b;">Our Partners</h4>	
								<div class="social-icons">

									<ul class="nomargin">

										<a href="https://www.facebook.com/bootsnipp"><i class="fa fa-facebook-square fa-3x social-fb" id="social"></i></a>
										<a href="https://twitter.com/bootsnipp"><i class="fa fa-twitter-square fa-3x social-tw" id="social"></i></a>
										<a href="https://plus.google.com/+Bootsnipp-page"><i class="fa fa-google-plus-square fa-3x social-gp" id="social"></i></a>
										<a href="mailto:bootsnipp@gmail.com"><i class="fa fa-envelope-square fa-3x social-em" id="social"></i></a>

									</ul>
								</div>

							</ul>

						</div>
					</div>
				</div>
			</footer>
			<!--header-->

			<!-- FOOTER COPYRIGHT -->
			<div class="footer-bottom">
				<div class="container">
					<div class="row">

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="copyright">

								© <?= date('Y') ?>, <?= $webname ?>, All rights reserved

							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="design">

								Development by <a target="_blank" href="http://www.webenlance.com">Faiz Noeris</a>

							</div>
						</div>

					</div>
				</div>
			</div>



			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="<?= base_url('/assets/js/jquery-3.2.1.min.js') ?>" ></script>
			<script src="<?= base_url('/assets/js/popper.min.js') ?>" ></script>
			<script src="<?= base_url('/assets/js/bootstrap.min.js') ?>" ></script>
			<!-- Angular JS -->
			<script src="<?= base_url('/assets/js/angular.min.js') ?>"></script>
			<!-- Holder JS -->
			<script src="https://getbootstrap.com/assets/js/vendor/holder.min.js" ></script>
			<!-- Hoover Zoom (Product Details) JS -->
			<script src="<?= base_url('/assets/js/hoverzoom.js') ?>"></script>
			<!-- Hoover Zoom (Product Details) JS -->
			<script src="<?= base_url('/assets/js/script.js') ?>"></script>

		</body>
		</html>