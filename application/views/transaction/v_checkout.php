<!-- Content area -->
<div class="content">		 
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Kantong Belanja</h5>
		</div>

		<form method="post" action="<?php echo base_url('Shopping/placeorder/');?>">
			<div class="panel-body">
				<p class="content-group">Barang yang ingin anda pesan akan masuk ke dalam kantong belanja yang dapat dilihat pada tabel dibawah.</p>



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

					<div class="panel panel-flat" style="width: 35rem !important;">
						<div class="panel-heading">
							<h5 class="panel-title">Alamat Pemesanan</h5>
						</div>
						<div class="panel-body" id="alamatbox">
							<h4 class="card-title"><?= $alamatfirst['namaalamat'] ?></h4>
							<h6 class="card-subtitle mb-2 text-muted">a.n <?= $alamatfirst['atas_nama'] ?></h6>
							<p class="card-text"><b>Alamat:</b><br><?= $alamatfirst['alamat'] ?><br><br><!-- <b>Provinsi:</b><br><?= $alamatfirst['provinsi'] ?><br><br><b>Kabupaten:</b><br><?= $alamatfirst['kabupaten'] ?><br><br> --><b>Telephone:</b><br><?= $alamatfirst['telephone'] ?></p>
						</div>
					</div>

					<h2>Items</h2><br>

					<div class="table-responsive">
						<table class="table table-framed">
							<thead>
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
					</div>

					<br>


				</div>

				<div class="panel-footer">
					<div class="heading-elements">
						<button type="submit" class="btn btn-primary heading-btn pull-right" id="btnsubmit">Place Order <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
