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

	<div class="container" >

		

		<h2>Order</h2>
		<p>
			User: <?= $data_user['username'] ?><br>
			Billing Address Details: 
		</p>



		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h4 class="card-title"><?= $data_alamat->namaalamat ?></h4>
				<h6 class="card-subtitle mb-2 text-muted">a.n <?= $data_alamat->atasnama ?></h6>
				<p class="card-text"><b>Alamat:</b><br><?= $data_alamat->alamat ?><br><br><b>Telephone:</b><br><?= $data_alamat->telephone ?></p>
			</div>
		</div>

		<br><br><br><br><br><br><br><br><br><br><br>
		<form method="post" action="<?php echo base_url('Shopping/placeorder/');?>">
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="paymentmethod" value="Cash on Delivery">
					Cash on Delivery
				</label>
			</div>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="paymentmethod" value="Direct Bank Transfer">
					Direct Bank Transfer
				</label>
			</div>



			<h2>Items</h2><br>

			<table class="table table-responsive">
				<thead class="thead-default">
					<tr>
						<th width="5%">#</th>
						<th width="15%">Kode Barang</th>
						<th width="20%">Gambar</th>
						<th width="32%">Nama Barang</th>
						<th width="15%">Jumlah</th>
						<th width="13%">Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1; 
					$total = 0;
					$totaloneprod = 0;
					?>

					<?php foreach ($this->cart->contents() as $items): ?>

						<tr>
							<th scope="row"><?= $i; ?></th>
							<th><?= $items['id'] ?></th>
							<td><img src="https://id-live-03.slatic.net/p/7/distro-bandung-vr-355-sepatu-kets-sneakers-dan-kasual-pria-hitam-1487054474-20960041-d5ab29e5322276e9da877a49cd42cc3c.jpg" width="130" height="130"></td>
							<td><?= $items['name'] ?></td>
							<td>	<?= $items['qty'] ?>	</td>
							<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>

							<?php $totaloneprod = $items['price'] * $items['qty'] ?>
							<?php $total += $totaloneprod ?>
							<?php $totaloneprod = 0; ?>

						</tr>


						<?php $i++; ?>

					<?php endforeach; ?>
					<tr>
						<th scope="row"></th>
						<td colspan="4" class="text-center"><b>TOTAL HARGA</b></td>
						<td colspan="5"><b>Rp. <?= number_format($total, 0, ',', '.') ?></b></td>
					</tr>
				</tbody>
			</table>

			<br>

			<div class="text-right">
				<button type="submit" class="btn btn-primary" id="btnsubmit">Place Order</button>
			</div>

			<hr class="featurette-divider">
		</form>

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