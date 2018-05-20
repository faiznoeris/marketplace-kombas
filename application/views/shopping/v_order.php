<!-- Content area -->
<div class="content">	

	<!-- Clickable title -->
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Pemesanan Barang</h6>
		</div>

		<form class="steps-validation" id="form_order" method="post" action="<?php echo base_url('Shopping/placeorder/');?>">
			<h6>Alamat Pengiriman</h6>
			<fieldset>
				<legend class="text-semibold">Pilih Alamat Untuk Pengiriman Barang</legend>

				<div class="row">
					<div class="form-group">

						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
							<select name="alamat" id="alamat" data-placeholder="Pilih alamat pengiriman" class="select required">
								<option></option>
								<?php
								$alamatfirst = array();
								foreach ($data_alamat as $row) {

									echo "<option value='".$row->id_address."'>".$row->namaalamat."</option>";
									// $alamatfirst['namaalamat'] = '-';//$row->namaalamat; 
									// $alamatfirst['atas_nama'] = '-';////$row->atasnama; 
									// $alamatfirst['alamat'] = '-';////$row->alamat; 
									// $alamatfirst['provinsi'] = '-';//$row->provinsi;
									// $alamatfirst['kabupaten'] = $row->kabupaten;
									// $alamatfirst['telephone'] = '-';//$row->telephone; 

								}
								?>			
							</select>
						</div>
						<div class="col-lg-2">
							<a class="btn btn-primary white-text" href="<?= base_url('account/alamat/tambah') ?>">Tambah Alamat</a>
						</div>

					</div>
				</div>

				<br>
				<hr>

				<div class="row" style="padding: 10px 10px 10px 10px;">
					<div class="panel panel-flat" style="background-color: #fcfcfc !important;">
						<div class="panel-heading" style="background-color: #fcfcfc !important;">
							<h5 class="panel-title">Barang dikirim ke</h5>
						</div>
						<div class="panel-body" id="alamatbox">
							<table class="table">
								<tbody>
									<tr>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Nama Penerima</b></td>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Alamat Lengkap</b></td>
									</tr>
									<tr>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
									</tr>
									<tr>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>No. Telepon</b></td>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Provinsi</b></td>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Kabupaten / Kota</b></td>
										<td style="border-top: none !important; padding-bottom: 0 !important;"><b>Kode Pos</b></td>
									</tr>
									<tr>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
										<td style="border-top: none !important; padding-bottom: 0 !important;">-</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<br>
			</fieldset>

			<h6>Jasa Pengiriman</h6>
			<fieldset>
				<legend class="text-semibold">Pilih Jasa Pengiriman Yang Ingin Digunakan</legend>
				<div class="row" style="padding: 10px 10px 10px 10px;">

					<div class="row" style="padding: 10px 10px 10px 10px;">
						<div class="panel panel-flat" style="background-color: #fcfcfc !important;">
							<div class="panel-heading" style="background-color: #fcfcfc !important;">
								<h5 class="panel-title">Barang dikirim ke</h5>
							</div>
							<div class="panel-body" id="alamatbox2">
								<table class="table">
									<tbody>
										<tr>
											<td style="border-top: none !important;"><b>Nama Penerima</b></td>
											<td style="border-top: none !important;"><b>Alamat Lengkap</b></td>
										</tr>
										<tr>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
										</tr>
										<tr>
											<td style="border-top: none !important;"><b>No. Telepon</b></td>
											<td style="border-top: none !important;"><b>Provinsi</b></td>
											<td style="border-top: none !important;"><b>Kabupaten / Kota</b></td>
											<td style="border-top: none !important;"><b>Kode Pos</b></td>
										</tr>
										<tr>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<h2>Items</h2>


					<div class="table-responsive">
						<table class="table table-framed">

							<tbody id="ongkir_table">

							</tbody>
						</table>
					</div>
				</div>
				<br>
			</fieldset>

			<h6>Pembayaran</h6>
			<fieldset>
				<legend class="text-semibold">Rekening Pembayaran Transaksi</legend>
				<div class="row" style="padding: 10px 10px 10px 10px;">

					<div class="row" style="padding: 10px 10px 10px 10px;">
						<div class="panel panel-flat" style="background-color: #fcfcfc !important;">
							<div class="panel-heading" style="background-color: #fcfcfc !important;">
								<h5 class="panel-title">Barang dikirim ke</h5>
							</div>
							<div class="panel-body" id="alamatbox3">
								<table class="table">
									<tbody>
										<tr>
											<td style="border-top: none !important;"><b>Nama Penerima</b></td>
											<td style="border-top: none !important;"><b>Alamat Lengkap</b></td>
										</tr>
										<tr>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
										</tr>
										<tr>
											<td style="border-top: none !important;"><b>No. Telepon</b></td>
											<td style="border-top: none !important;"><b>Provinsi</b></td>
											<td style="border-top: none !important;"><b>Kabupaten / Kota</b></td>
											<td style="border-top: none !important;"><b>Kode Pos</b></td>
										</tr>
										<tr>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
											<td style="border-top: none !important;">-</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-framed">
							<tbody id="ongkir_table_4">
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
									return array_count_values( $new_array );
								}

								$totalprodperseller = assc_array_count_values($cart, 'seller');

								?>

								<?php foreach ($cart as $items): ?>

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

									<tr>	
										<td><a href="<?= base_url('/product/'.$items['id_prod']) ?>" class="text-semibold" style="color: black !important;"><img src="<?= base_url($items['sampul']) ?>" width="130" height="130"> &emsp; <?= $items['name'] ?></a></td>
										<td><?= $items['qty'] ?></td>
										<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?> <b style="font-size: 17px !important;">x <?= $items['qty'] ?></b></td>
										<td><b>Rp. <?= number_format($items['price']*$items['qty'], 0, ',', '.') ?></b></td>
										<td id="ongkirphase4_<?= $items['id_prod'] ?>"></td>
										

										<?php $totaloneprod = $items['price'] * $items['qty'] ?>
										<?php $total += $totaloneprod ?>
										<?php $totaloneprod = 0; ?>
									</tr>

									<tr>
										<td colspan="5" style="border-top: none !important; background-color: #fcfcfc !important;">
											<div class="panel-footer" style="border-top: none !important; padding: 0 !important">
												<div class="heading-elements">

													<?php 
													$kota_toko = "-";
													for ($i=0; $i < count($rajaongkir_kota); $i++) { 
														if($rajaongkir_kota[$i]['city_id'] == $items['asal']){
															$kota_toko = $rajaongkir_kota[$i]['city_name'];
														}
													}
													?>

													<span class="heading-text text-semibold"><?= number_format($items['berat'], 0, ',', '.') ?>gr &emsp; | &emsp; Dikirim oleh: <?= $items['seller'] ?> &emsp; | &emsp; <i class="icon-location4"></i> <?= $kota_toko ?></span>
												</div>
											</div>
										</td>
									</tr>


									<?php $i++; ?>

								<?php endforeach; ?>
								<tr>
									<td></td>
									<td></td>
									<td class="text-center"><b>HARGA DAN ONGKIR</b></td>
									<td><b>Rp. <?= number_format($total, 0, ',', '.') ?></b></td>
									<td id="total_ongkir"></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-center"><b>SUB TOTAL</b></td>
									<td id="total"></td>
								</tr>
							</tbody>
						</table>

						<?php if($saldo != 0): ?>

							<div class="checkbox checkbox-right pull-right">
								<label>
									<input type="checkbox" class="styled" id="incl_saldo" name="incl_saldo">
									Include Saldo 
								</label>
							</div>

						<?php endif; ?>

					</div>

					<center>
						<h2>Transfer</h2>
						<span>Pilih salah satu dari rekening bank dibawah <br>untuk mentransfer dana pembelian<br>*<b>Semua rekening Atas Nama: PT. Kombas</b></span><br><br>
						<table>

							<?php foreach($data_bank as $row): ?>
								<tr>
									<td class="text-center" style="padding-right:10px"><?= $row->no_rekening ?></td>
									<td class="text-center"><?= $row->nama_bank ?></td>
								</tr>
							<?php endforeach; ?>

						</table>
						<br>
						<span style="font-size: 25px;" id="total_trf"></b></span>
						<input type="hidden" name="total_trf" id="input_total_trf">
						<input type="hidden" name="total_brg" id="total_brg_trf">
						<input type="hidden" name="kode_trf" id="kode_unik_trf">
						<input type="hidden" name="balik_saldo" id="balik_saldo_trf">
						<input type="hidden" name="from_saldo" id="from_saldo_trf">
						<input type="hidden" name="current_saldo" id="current_saldo_trf" value="<?= $saldo ?>">
						<br>
						<span style="color: red">3 angka terakhir yang berwarna merah adalah kode unik transfer</span><br>
						<span>Harap melakukan Transfer <br>sesuai dengan jumlah yang ada diatas</span>
					</center>
				</div>

				<br>
			</fieldset>
		</form>

	</div>
	<!-- /clickable title -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
