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

		<form method="post" action="<?php echo base_url('Shopping/placeorder/');?>">

			<div class="row">
				<!-- <div class="form-group"> -->
					<label class="control-label col-lg-2">Alamat</label>
					<div class="col-lg-3">
						<select name="alamat" class="form-control" id="alamat">
							<?php
							$first = true;
							$alamatfirst = array();
							foreach ($data_alamat as $row) {

								if($first){
									echo "<option value='".$row->id_address."' selected>".$row->namaalamat."</option>";
									$alamatfirst['namaalamat'] = $row->namaalamat; 
									$alamatfirst['atas_nama'] = $row->atasnama; 
									$alamatfirst['alamat'] = $row->alamat; 
									$alamatfirst['provinsi'] = $row->provinsi;
									$alamatfirst['kabupaten'] = $row->kabupaten;
									$alamatfirst['telephone'] = $row->telephone; 
									$first = false;
								}else{
									echo "<option value='".$row->id_address."'>".$row->namaalamat."</option>";
								}

							}
							?>			
						</select>
					</div>
					<div class="col-lg-2">
						<a class="btn btn-primary white-text" href="<?= base_url('dashboard/alamat/add') ?>">Tambah Alamat</a>
					</div>
					<!-- </div> -->
				</div>
				<br><br>
				<div class="card" style="width: 18rem;">
					<div class="card-body" id="alamatbox">
						<h4 class="card-title"><?= $alamatfirst['namaalamat'] ?></h4>
						<h6 class="card-subtitle mb-2 text-muted">a.n <?= $alamatfirst['atas_nama'] ?></h6>
						<p class="card-text"><b>Alamat:</b><br><?= $alamatfirst['alamat'] ?><br><br><!-- <b>Provinsi:</b><br><?= $alamatfirst['provinsi'] ?><br><br><b>Kabupaten:</b><br><?= $alamatfirst['kabupaten'] ?><br><br> --><b>Telephone:</b><br><?= $alamatfirst['telephone'] ?></p>
					</div>
				</div> 

				<br><br><br><br><br><br><br><br><br><br><br>

<!-- 				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" name="paymentmethod" value="Saldo">
						Saldo
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" name="paymentmethod" value="Direct Bank Transfer">
						Direct Bank Transfer
					</label>
				</div> -->

				<h2>Items</h2><br>

				<table class="table table-responsive">
					<thead class="thead-default">
						<tr>
							<th width="5%">#</th>
							<!-- <th width="15%">Kode Barang</th> -->
							<th width="10%">Seller</th>
							<th width="15%">Gambar</th>
							<th width="20%">Nama Barang</th>
							<th width="10%">Jumlah</th>
							<th width="13%">Harga</th>
							<th width="12%">Kurir</th>
							<th width="10%" colspan="3">Ongkir</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1; 
						$total = 0;
						$totaloneprod = 0;
						$sellercount = 1;
						$cart = $this->cart->contents();
						$showongkir = true;
						$lastseller = "";

						function sortByName($a, $b)
						{
							$a = $a['seller'];
							$b = $b['seller'];

							if ($a == $b) return 0;
							return ($a < $b) ? -1 : 1;
						}

						usort($cart, 'sortByName');

						$berat = 0;
						$first = true;

						function assc_array_count_values( $array, $key ) {
							foreach( $array as $row ) {
								$new_array[] = $row[$key];
							}
							// print_r(array_count_values( $new_array ));
							return array_count_values( $new_array );
						}

						$totalprodperseller = assc_array_count_values($cart, 'seller');

						?>
						<?php foreach ($cart as $items): ?>


							<tr>
								<th scope="row"><?= $i ?></th>
								<!-- <th><?= $items['id'] ?></th> -->
								<th><?= $items['seller'] ?></th>
								<td><img src="<?= $items['sampul'] ?>" width="130" height="130"></td>
								<td><?= $items['name'] ?></td>
								<td><?= $items['qty'] ?></td>
								<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
								
								<?php

								$berat = $berat + $items['berat'];

								if($totalprodperseller[$items['seller']] != 1){

									if($totalprodperseller[$items['seller']] > 2){

										if($sellercount == $totalprodperseller[$items['seller']]){
											$showongkir = true;
										}else{
											$sellercount++;
											$showongkir = false;
										}
										

									}else{

										if($lastseller != $items['seller'] && $first == true){
											$first = false;
											$showongkir = false;

										}else if($lastseller != $items['seller'] && $first == false){
											$first = true;
											$showongkir = false;
										}else{
											$sellercount++;
											$showongkir = true;
										}

									}
								}else{
									$showongkir = true;
								}

								$lastseller = $items['seller'];


								?>


								<?php if($showongkir): ?>
									<td><select name="kurir<?= $items['id_prod'] ?>" class="kurir form-control">
										<option value="-" selected>Pilih Kurir</option>

										<?php 


										$shop = $this->m_shop->selectidshop($items['id_shop'])->row();

										$kurir = explode(',',$shop->kurir);

										foreach ($kurir as $row) {

											if(!empty($row)){
												echo "<option value='".$row."|".$items['asal']."|".$alamatfirst['kabupaten']."|".$berat."|".$items['id_prod']."|".$items['id_prod']."'>".$row."</option>";
											}
										}

										$berat = 0;
										?>
									</select></td>
									<td>
										<span id="ongkir_<?= $items['id_prod'] ?>"></span>

									</td>


								<?php else: ?>
									<td></td>
									<td></td>
								<?php endif; ?>


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