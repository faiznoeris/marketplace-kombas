<div id="jGrowl-penjualan-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Penjualan</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Penjualan</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Daftar Order</b></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>#</th>
						<th>Id Transaksi</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Kurir & Paket</th>
						<th>Status</th>
						<th class="text-center">Aksi</th>

					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					<?php foreach ($data_pembelian as $row): ?>

						<?php

						$dontcount = false;

						$prods = explode(',', $row->id_product); 

						//removing whitespace and counting how many product ordered in the shop
						$index = array_search('', $prods); 
						if ( $index !== false ) {
							unset( $prods[$index] );
						}

						$prod_detail = $this->m_products->getproduct($row->id_product)->row();
						$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();

						?>

						<?php if(count($prods) < 2): ?>

							<tr>
								<td><?= $counter ?></td>
								<td><?= $row->id_transaction ?></td>
								<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
								<td><?= $history_product->qty ?></td>
								<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
								<td><?= strtoupper($row->kurir) ?>&emsp;|&emsp;<?= $row->jenis_paket ?></td>
								<td><?= $row->status ?></td>
								<?php if($row->status == "Transfer Received By Admin" || $row->status == "On Delivery"):?>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">

													<?php if($row->status == "Transfer Received By Admin"):?>
														<li><a data-toggle="modal" data-target="#modal_brgdikirim_<?= $row->id_transaction ?>") ?> Barang Dikirim</a></li>
													<?php else: ?>
														<li class="disabled"><a> Barang Dikirim</a></li>
													<?php endif; ?>



													<?php if($row->status == "On Delivery"):?>
														<li><a data-toggle="modal" data-target="#modal_updateresi_<?= $row->id_transaction ?>"> Update Resi</a></li>
													<?php else: ?>
														<li class="disabled"><a> Update Resi</a></li>
													<?php endif; ?>


													<li><a data-toggle="modal" data-target="#modal_alamat_<?= $row->id_transaction ?>"> Alamat Pengiriman</a></li>

												</ul>
											</li>
										</ul>
									</td>
								<?php elseif($row->status == "Pending" || $row->status == "Transfer Confirmed By User"): ?>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">

													<li><a data-toggle="modal" data-target="#modal_cancelorder_<?= $row->id_transaction ?>") ?> Cancel</a></li>

												</ul>
											</li>
										</ul>
									</td>
								<?php else: ?>
									<td></td>
								<?php endif; ?>


								<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

								<?php

										//RAJA ONGKIR API GET PROVINSI

								$curl = curl_init();	
								curl_setopt_array($curl, array(
									CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => "",
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 30,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => "GET",
									CURLOPT_HTTPHEADER => array(
										"key: e5629870cbd922e9156805e0ffe6625c"
									),
								));

								$response = curl_exec($curl);
								$err = curl_error($curl);

								curl_close($curl);

								$data = json_decode($response, true);

								?>



								<div id="modal_alamat_<?= $row->id_transaction ?>" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h5 class="modal-title">Alamat Pengiriman</h5>
											</div>


											<div class="modal-body">
												<!-- <h6 class="text-semibold">Text in a modal</h6> -->

												<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

												<h4 class="card-title"><?= $alamat->namaalamat ?></h4>
												<h6 class="card-subtitle mb-2 text-muted">a.n <?= $alamat->atasnama ?></h6>
												<p class="card-text"><b>Alamat:</b><br><?= $alamat->alamat ?>
													<br>
													<i><?= $alamat->kodepos ?></i><br>

													<?php
													for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
														if($data['rajaongkir']['results'][$i]['province_id'] == $alamat->provinsi){
															echo "<i>".$data['rajaongkir']['results'][$i]['province']."</i>";
														}

													}
													?>	
													<br>

													<?php

															//RAJA ONGKIR API GET KABUPATEN

													$curl = curl_init();	
													curl_setopt_array($curl, array(
														CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$alamat->provinsi,
														CURLOPT_RETURNTRANSFER => true,
														CURLOPT_ENCODING => "",
														CURLOPT_MAXREDIRS => 10,
														CURLOPT_TIMEOUT => 30,
														CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
														CURLOPT_CUSTOMREQUEST => "GET",
														CURLOPT_HTTPHEADER => array(
															"key: e5629870cbd922e9156805e0ffe6625c"
														),
													));

													$response = curl_exec($curl);
													$err = curl_error($curl);

													curl_close($curl);

													$data = json_decode($response, true);
													?> 

													<?php
													for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
														if($data['rajaongkir']['results'][$i]['city_id'] == $alamat->kabupaten){
															echo "<i>".$data['rajaongkir']['results'][$i]['city_name']."</i>";
														}

													}
													?>

													<br><br>
													<b>Telephone: </b> <?= $alamat->telephone ?>
												</p>
												<br>

											</div>

											<div class="modal-footer">

												<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

											</div>


										</div>
									</div>
								</div>



								<!-- Basic modal -->
								<div id="modal_cancelorder_<?= $row->id_transaction ?>" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h5 class="modal-title">Cancel Order</h5>
											</div>

											<form method="post" action="<?php echo base_url('Seller/cancelorder/'.$row->id_transaction.'/'.count($prods));?>">

												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->

													<p>Apakah anda ingin meng-cancel order?</p>

													<br>

												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Confirm</button>

												</div>

											</form>

										</div>
									</div>
								</div>

								<div id="modal_brgdikirim_<?= $row->id_transaction ?>" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h5 class="modal-title">Konfirmasi Barang Dikirim</h5>
											</div>

											<form method="post" action="<?php echo base_url('Seller/barangdikirim/'.$row->id_transaction.'/'.count($prods));?>">

												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->

													<p>Apakah anda ingin mengkonfirmasi bahwa barang telah dikirim? <br>Jika iya silahkan isi kolom resi dibawah kemudian tekan confirm untuk konfirmasi barang telah dikirim ke pembeli.</p>
													<br>

													<div class="form-group">
														<label class="control-label col-lg-2">Resi</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="resi">
														</div>
													</div>


													<br>

												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Confirm</button>

												</div>

											</form>

										</div>
									</div>
								</div>


								<div id="modal_updateresi_<?= $row->id_transaction ?>" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h5 class="modal-title">Update Resi</h5>
											</div>

											<form method="post" action="<?php echo base_url('Seller/updateresi/'.$row->id_transaction.'/'.count($prods));?>">

												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->
													<div class="form-group">
														<label class="control-label col-lg-2">Resi</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="resi" value="<?= $row->resi ?>">
														</div>
													</div>


													<br>

												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Confirm</button>

												</div>

											</form>

										</div>
									</div>
								</div>

							</tr>

						<?php else: ?>

							<?php $first = true; ?>

							<?php foreach($prods as $p): ?>

								<?php 

								$prod_detail = $this->m_products->getproduct($p)->row(); 
								$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();

								?>

								<?php if($first): ?>

									<tr>
										<td><?= $counter ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $row->id_transaction ?></td>
										<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
										<td><?= $history_product->qty ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td rowspan="<?= count($prods) ?>"><?= strtoupper($row->kurir) ?>&emsp;|&emsp;<?= $row->jenis_paket ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $row->status ?></td>
										<?php if($row->status == "Transfer Received By Admin" || $row->status == "On Delivery"):?>
											<td rowspan="<?= count($prods) ?>" class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right">

															<?php if($row->status == "Transfer Received By Admin"):?>
																<li><a data-toggle="modal" data-target="#modal_brgdikirim_<?= $row->id_transaction ?>") ?> Barang Dikirim</a></li>
															<?php else: ?>
																<li class="disabled"><a> Barang Dikirim</a></li>
															<?php endif; ?>



															<?php if($row->status == "On Delivery"):?>
																<li><a data-toggle="modal" data-target="#modal_updateresi_<?= $row->id_transaction ?>"> Update Resi</a></li>
															<?php else: ?>
																<li class="disabled"><a> Update Resi</a></li>
															<?php endif; ?>

															<li><a data-toggle="modal" data-target="#modal_alamat_<?= $row->id_transaction ?>"> Alamat Pengiriman</a></li>

														</ul>
													</li>
												</ul>
											</td>
										<?php elseif($row->status == "Pending" || $row->status == "Transfer Confirmed By User"): ?>
											<td rowspan="<?= count($prods) ?>" class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right">

															<li><a data-toggle="modal" data-target="#modal_cancelorder_<?= $row->id_transaction ?>") ?> Cancel</a></li>

														</ul>
													</li>
												</ul>
											</td>
										<?php else: ?>
											<td rowspan="<?= count($prods) ?>"></td>
										<?php endif; ?>

										<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

										<?php

										//RAJA ONGKIR API GET PROVINSI

										$curl = curl_init();	
										curl_setopt_array($curl, array(
											CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
											CURLOPT_RETURNTRANSFER => true,
											CURLOPT_ENCODING => "",
											CURLOPT_MAXREDIRS => 10,
											CURLOPT_TIMEOUT => 30,
											CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
											CURLOPT_CUSTOMREQUEST => "GET",
											CURLOPT_HTTPHEADER => array(
												"key: e5629870cbd922e9156805e0ffe6625c"
											),
										));

										$response = curl_exec($curl);
										$err = curl_error($curl);

										curl_close($curl);

										$data = json_decode($response, true);

										?>



										<div id="modal_alamat_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Alamat Pengiriman</h5>
													</div>


													<div class="modal-body">
														<!-- <h6 class="text-semibold">Text in a modal</h6> -->

														<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

														<h4 class="card-title"><?= $alamat->namaalamat ?></h4>
														<h6 class="card-subtitle mb-2 text-muted">a.n <?= $alamat->atasnama ?></h6>
														<p class="card-text"><b>Alamat:</b><br><?= $alamat->alamat ?>
															<br>
															<i><?= $alamat->kodepos ?></i><br>

															<?php
															for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
																if($data['rajaongkir']['results'][$i]['province_id'] == $alamat->provinsi){
																	echo "<i>".$data['rajaongkir']['results'][$i]['province']."</i>";
																}

															}
															?>	
															<br>

															<?php

															//RAJA ONGKIR API GET KABUPATEN

															$curl = curl_init();	
															curl_setopt_array($curl, array(
																CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$alamat->provinsi,
																CURLOPT_RETURNTRANSFER => true,
																CURLOPT_ENCODING => "",
																CURLOPT_MAXREDIRS => 10,
																CURLOPT_TIMEOUT => 30,
																CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																CURLOPT_CUSTOMREQUEST => "GET",
																CURLOPT_HTTPHEADER => array(
																	"key: e5629870cbd922e9156805e0ffe6625c"
																),
															));

															$response = curl_exec($curl);
															$err = curl_error($curl);

															curl_close($curl);

															$data = json_decode($response, true);
															?> 

															<?php
															for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
																if($data['rajaongkir']['results'][$i]['city_id'] == $alamat->kabupaten){
																	echo "<i>".$data['rajaongkir']['results'][$i]['city_name']."</i>";
																}

															}
															?>

															<br><br>
															<b>Telephone: </b> <?= $alamat->telephone ?>
														</p>
														<br>

													</div>

													<div class="modal-footer">

														<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

													</div>


												</div>
											</div>
										</div>

										<!-- Basic modal -->
										<div id="modal_cancelorder_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Cancel Order</h5>
													</div>

													<form method="post" action="<?php echo base_url('Seller/cancelorder/'.$row->id_transaction.'/'.count($prods));?>">

														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<p>Apakah anda ingin meng-cancel order?</p>

															<br>

														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Confirm</button>

														</div>

													</form>

												</div>
											</div>
										</div>

										<div id="modal_brgdikirim_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Konfirmasi Barang Dikirim</h5>
													</div>
													<form method="post" action="<?php echo base_url('Seller/barangdikirim/'.$row->id_transaction.'/'.count($prods));?>">

														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<p>Apakah anda ingin mengkonfirmasi bahwa barang telah dikirim? <br>Jika iya silahkan isi kolom resi dibawah kemudian tekan confirm untuk konfirmasi barang telah dikirim ke pembeli.</p>
															<br>

															<div class="form-group">
																<label class="control-label col-lg-2">Resi</label>
																<div class="col-lg-7">
																	<input type="text" class="form-control" name="resi">
																</div>
															</div>


															<br>

														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Confirm</button>

														</div>

													</form>
												</div>
											</div>
										</div>

										<div id="modal_updateresi_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Update Resi</h5>
													</div>

													<form method="post" action="<?php echo base_url('Seller/updateresi/'.$row->id_transaction.'/'.count($prods));?>">

														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->
															<div class="form-group">
																<label class="control-label col-lg-2">Resi</label>
																<div class="col-lg-7">
																	<input type="text" class="form-control" name="resi" value="<?= $row->resi ?>">
																</div>
															</div>


															<br>

														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Confirm</button>

														</div>

													</form>

												</div>
											</div>
										</div>


									</tr>

									<?php $first = false; ?>

								<?php else: ?>

									<tr>
										<td><?= $counter ?></td>
										<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
										<td><?= $history_product->qty ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
									</tr>

								<?php endif; ?>

								<?php $counter++; $dontcount = true; ?>

							<?php endforeach; ?>

						<?php endif; ?>

						<?php if(!$dontcount){$counter++;}  ?>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
		<!-- /basic datatable -->


		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->