<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/checkout.css') ?>">
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('/assets/images/favicon.png') ?>">
	<!-- Iconic -->
	<link href="<?= base_url('assets/open-iconic-master/font/css/open-iconic-bootstrap.css') ?>" rel="stylesheet">

	<title><?= $title ?></title>

</head>
<body>

	<div class="container">

		<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="<?= base_url('/assets/images/favicon.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
				Pekanita
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="<?= base_url('') ?>">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Features</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Pricing</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Search" size="35	">
					<button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
				</form>
				<a class="btn btn-primary" href="<?= base_url('cart') ?>" style="margin-left: 10px;">
					<span class="oi oi-cart"></span>
				</a>
				
			</div>


		</nav>

		
		<hr class="featurette-divider">

		<div class="row"> 
			<div class="col-sm-4 alurpemesananleft">
				Keranjang Belanja
			</div>
			<div class="col-sm-4 alurpemesanancenter">
				Ringkasan
			</div>
			<div class="col-sm-4 alurpemesananright">
				Konfirmasi Pemesanan
			</div>
		</div>

		<br>

		<!-- <div class="row"> -->
			<div class="form-group">
				<div class="circleactive" style="float:left"></div>
				<div class="circle" style="float: right;"></div>
				<div class="circle"></div>
			</div>
	<!-- 	</div> -->



		<hr class="featurette-divider">

		<h2>My Cart</h2><br>

		<table class="table table-responsive">
			<thead class="thead-default">
				<tr>
					<th width="11%">#</th>
					<th width="21%">Gambar</th>
					<th width="33%">Nama Barang</th>
					<th width="16%">Jumlah</th>
					<th width="14%">Harga</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1</th>
					<td><img src="https://id-live-03.slatic.net/p/7/distro-bandung-vr-355-sepatu-kets-sneakers-dan-kasual-pria-hitam-1487054474-20960041-d5ab29e5322276e9da877a49cd42cc3c.jpg" width="130" height="130"></td>
					<td>Sepatu kets sneakers dan kasual pria hitam</td>
					<td>4</td>
					<td>Rp. 1.200.000</td>
				</tr>
				<tr>
					<th scope="row">2</th>
					<td><img src="https://id-live-03.slatic.net/p/7/distro-bandung-vr-355-sepatu-kets-sneakers-dan-kasual-pria-hitam-1487054474-20960041-d5ab29e5322276e9da877a49cd42cc3c.jpg" width="130" height="130"></td>
					<td>Sepatu kets sneakers dan kasual pria hitam</td>
					<td>1</td>
					<td>Rp. 300.000</td>
				</tr>
				<tr>
					<th scope="row">3</th>
					<td><img src="https://id-live-03.slatic.net/p/7/distro-bandung-vr-355-sepatu-kets-sneakers-dan-kasual-pria-hitam-1487054474-20960041-d5ab29e5322276e9da877a49cd42cc3c.jpg" width="130" height="130"></td>
					<td>Sepatu kets sneakers dan kasual pria hitam</td>
					<td>1</td>
					<td>Rp. 300.000</td>
				</tr>
				<tr>
					<th scope="row"></th>
					<td colspan="3" class="text-center"><b>TOTAL HARGA</b></td>
					<td><b>Rp. 1.800.000</b></td>
				</tr>
			</tbody>
		</table>

		<br>

		<a href="#" class="btn btn-primary float-right">Lanjut</a>

		<hr class="featurette-divider">

		<!-- FOOTER -->
		<footer class="footer">
			<p class="float-right"><a href="#">Back to top</a></p>
			<p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
		</footer>

	</div> <!-- /container -->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?= base_url('/assets/js/jquery-3.2.1.min.js') ?>" ></script>
	<script src="<?= base_url('/assets/js/popper.min.js') ?>" ></script>
	<script src="<?= base_url('/assets/js/bootstrap.min.js') ?>" ></script>
	<!-- Angular JS -->
	<script src="<?= base_url('/assets/js/angular.min.js') ?>"></script>

	<script src="<?= base_url('/assets/js/hoverzoom.js') ?>"></script>
	<script src="https://getbootstrap.com/assets/js/vendor/holder.min.js" ></script>

</body>
</html>