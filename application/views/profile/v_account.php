<div class="content">

	<!-- Cover area --> 
	<div class="panel panel-remove-outline profile-cover">
		<div class="profile-cover-img" style="background-image: url(<?= base_url($data_user['cover_path']) ?>)"></div>
		<div class="media">

			<div class="media-body">
				<h1><?= $data_user["nama_lgkp"] ?> <small class="display-block"><?= $user_lvl_name ?></small></h1>
			</div>

			<div class="media-right media-middle">
				<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
					<li><a href="<?= base_url('account/profile#pengaturan') ?>" class="btn btn-default" data-toggle="tab"><i class="icon-file-picture position-left"></i> Ubah cover</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /cover area -->

	<!-- User profile -->
	<div class="row">

		<?php if(!empty($data_exceed)): ?>
			<?php foreach($data_exceed->result() as $row): ?>
				<?php $count_item = $this->M_Index->data_account_countproduct($row->id_shop,$row->id_transaction)->num_rows(); ?>
				<div id="modal_ship_<?= $row->id_transaction ?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">

							<form method="post" action="<?php echo base_url('Seller/barangdikirim/'.$row->id_transaction.'/'.$count_item);?>">

								<div class="modal-header bg-info">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h6 class="modal-title">Barang Telah Dikirim</h6>
								</div>

								<div class="modal-body">
									<p>Apakah anda ingin mengkonfirmasi bahwa barang telah dikirim? <br>Jika iya silahkan isi kolom resi dibawah kemudian tekan konfirmasi untuk konfirmasi barang telah dikirim ke pembeli.</p>
									<br>

									<input type="text" class="form-control" name="resi" placeholder="Masukkan resi pengiriman">

									<br>
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-info">Konfirmasi</button>
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								</div>

							</form>

						</div>
					</div>
				</div>

			<?php endforeach; ?>
		<?php endif; ?>

		<div id="modal_detailtransaksi" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-info">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h6 class="modal-title title_detailtransasksi">

						</h6>
					</div>

					<div class="modal-body body_detailtransasksi">

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-9">
			<div class="tabbable">
				<div class="tab-content">
					<div class="tab-pane fade in active" id="activity">

						<?php if($user_lvl_name == "Seller"): ?>

							<input type="hidden" name="id_toko" id="id_toko" value="<?= $data_user["id_shop"] ?>">

							<h2 class="content-group text-semibold">
								<i class="icon-statistics"></i> Stats Toko
							</h2>


							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="panel panel-body bg-indigo-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-body">
												<h3 class="no-margin"><?= number_format($totalorder, 0, ',', '.') ?></h3>
												<span class="text-uppercase text-size-mini">total orders</span>
											</div>

											<div class="media-right media-middle">
												<i class="icon-bag icon-3x opacity-75"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-md-3">
									<div class="panel panel-body bg-primary-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-body">
												<h3 class="no-margin"><?= number_format($totalorderonprocess, 0, ',', '.') ?></h3>
												<span class="text-uppercase text-size-mini">total orders on process</span>
											</div>
											<div class="media-right media-middle">
												<i class="icon-bag icon-3x opacity-75"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-md-3">
									<div class="panel panel-body bg-violet-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-body">
												<h3 class="no-margin"><?= number_format($totalproductreview, 0, ',', '.') ?></h3>
												<span class="text-uppercase text-size-mini">total product reviewed</span>
											</div>

											<div class="media-right media-middle">
												<i class="icon-bubbles4 icon-3x opacity-75"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-md-3">
									<div class="panel panel-body bg-indigo-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-body">
												<h3 class="no-margin"><?= number_format($totalproductviews, 0, ',', '.') ?></h3>
												<span class="text-uppercase text-size-mini">total product clicked</span>
											</div>

											<div class="media-right media-middle">
												<i class="icon-pointer icon-3x opacity-75"></i>
											</div>
										</div>
									</div>
								</div>
								
							</div>

							<div class="row">
								<div class="col-md-3">

									<!-- Orders processed -->
									<div class="panel panel-body text-center bg-primary-400 has-bg-image">
										<div class="svg-center position-relative" id="progress_icon_three"></div>
										<h2 class="progress-percentage mt-15 mb-5 text-semibold">0%</h2>

										Orders on delivery
										<div class="text-size-small opacity-75"><?= number_format($totalorderprocessed, 0, ',', '.') ?> orders on delivery</div>
									</div>
									<!-- /orders processed -->

								</div>

								<div class="col-md-3">

									<!-- Order shipped -->
									<div class="panel panel-body text-center bg-success-400 has-bg-image">
										<div class="svg-center position-relative" id="progress_icon_four"></div>
										<h2 class="progress-percentage mt-15 mb-5 text-semibold">0%</h2>

										Orders shipped
										<div class="text-size-small opacity-75"><?= number_format($totalordershipped, 0, ',', '.') ?> orders shipped</div>
									</div>
									<!-- /orders shipped -->

								</div>
								<div class="col-md-3">

									<!-- Orders processed -->
									<div class="panel panel-body text-center bg-danger-400 has-bg-image">
										<div class="svg-center position-relative" id="progress_icon_five"></div>
										<h2 class="progress-percentage mt-15 mb-5 text-semibold">0%</h2>

										Orders cancelled
										<div class="text-size-small opacity-75"><?= number_format($totalordercancelled, 0, ',', '.') ?> orders cancelled</div>
									</div>
									<!-- /orders processed -->

								</div>

								<div class="col-md-3">

									<!-- Order shipped -->
									<div class="panel panel-body text-center bg-slate-400 has-bg-image">
										<div class="svg-center position-relative" id="progress_icon_six"></div>
										<h2 class="progress-percentage mt-15 mb-5 text-semibold">0%</h2>

										Orders pending
										<div class="text-size-small opacity-75"><?= number_format($totalorderpending, 0, ',', '.') ?> orders pending</div>
									</div>
									<!-- /orders shipped -->

								</div>
							</div>




							<h2 class="content-group text-semibold">
								<i class="icon-warning22"></i> Delivery Exceeded Deadline
								<small class="display-block">Transaksi anda yang waktu pengiriman barangnya telah melebihi batas waktu yang telah ditentukan.</small>
							</h2>
							<?php if($data_exceed->num_rows() > 0): ?>
								<div class="row">
									<?php $i = 1; ?>
									<?php foreach ($data_exceed->result() as $row): ?>
										<?php if($i < 7): ?>
											<?php $count_item = $this->M_Index->data_account_countproduct($row->id_shop,$row->id_transaction)->num_rows(); ?>
											<div class="col-lg-6">
												<div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
													<div class="panel-body">
														<div class="row">
															<div class="col-sm-6">
																<h6 class="text-semibold no-margin-top"><?= $row->username ?></h6>
																<ul class="list list-unstyled">
																	<li>ID Transaksi #<?= $row->id_transaction ?></li>
																	<li>Ordered from: <span class="text-semibold"><?= $row->date_ordered ?></span></li>
																</ul>
															</div>

															<div class="col-sm-6">
																<?php
																$total = $row->totalharga + $row->totalongkir;
																$total = substr($total, 0, -3).$row->kode_unik;
																?>
																<h6 class="text-semibold text-right no-margin-top">Rp. <?= number_format($total, 0, ',', '.') ?></h6>
																<ul class="list list-unstyled text-right">
																	<li>Total Items: <span class="text-semibold"><?= count(unserialize($row->cart)) ?></span></li>
																	<li class="dropdown">
																		Status: &nbsp;
																		<span class="label bg-danger-400">Overdue </span>
																	</li>
																</ul>
															</div>
														</div>
													</div>

													<div class="panel-footer panel-footer-condensed">
														<div class="heading-elements">

															<ul class="list-inline list-inline-condensed heading-text pull-right">
																<li><a href="#modal_detailtransaksi" class="text-default open-modal-detailtransaksi" data-toggle="modal" data-id="<?= $row->id_transaction ?>|<?= $row->id_shop ?>"><i class="icon-eye8"></i></a></li>
																<li><a data-toggle="modal" class="text-default" data-target="#modal_ship_<?= $row->id_transaction ?>"><i class="icon-truck"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>

										<?php endif; ?>
									<?php endforeach; ?>
								</div>

								<center>
									<a href="<?= base_url('account/profile#riwayat') ?>" data-toggle="tab" class="btn btn-link">See All Exceeded Deadline <br>(total of <?= $data_exceed->num_rows() ?> transaction pending)</a>	
								</center>

							<?php else: ?>

								<center>
									<span>Data delivery exceed deadline saat ini masih kosong.</span>
								</center>

							<?php endif; ?>

						<?php else: ?>

							<?php if($cancelled_order->num_rows() > 0): ?>
								<div class="row">
									<?php $i = 1; ?>
									<?php foreach ($cancelled_order->result() as $row): ?>
										<?php if($i < 7): ?>
											<div class="col-lg-6">
												<div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
													<div class="panel-body">
														<div class="row">
															<div class="col-sm-6">
																<h6 class="text-semibold no-margin-top"><?= $row->username ?></h6>
																<ul class="list list-unstyled">
																	<li>ID Transaksi #<?= $row->id_transaction ?></li>
																	<li>Ordered from: <span class="text-semibold"><?= $row->date_ordered ?></span></li>
																</ul>
															</div>

															<div class="col-sm-6">
																<?php
																// $total = $row->totalharga + $row->totalongkir;
																// $total = substr($total, 0, -3).$row->kode_unik;
																?>
																<h6 class="text-semibold text-right no-margin-top">Rp. <?= number_format($row->total, 0, ',', '.') ?></h6>
																<ul class="list list-unstyled text-right">
																	<li>Total Items: <span class="text-semibold"><?= count(unserialize($row->cart)) ?></span></li>
																	<li class="dropdown">
																		Status: &nbsp;
																		<span class="label bg-danger-400">Cancelled </span>
																	</li>
																</ul>
															</div>
														</div>
													</div>

													<div class="panel-footer panel-footer-condensed">
														<div class="heading-elements">

															<ul class="list-inline list-inline-condensed heading-text pull-right">
																<li><a href="#modal_detailtransaksi" class="text-default open-modal-detailtransaksi" data-toggle="modal" data-id="<?= $row->id_transaction ?>|<?= $row->id_shop ?>"><i class="icon-eye8"></i></a></li>
																<!-- <li><a data-toggle="modal" class="text-default" data-target="#modal_ship_<?= $row->id_transaction ?>"><i class="icon-truck"></i></a></li> -->
															</ul>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>

								</div>

								<div id="modal_detailtransaksi" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-info">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h6 class="modal-title title_detailtransasksi">

												</h6>
											</div>

											<div class="modal-body body_detailtransasksi">

											</div>

											<div class="modal-footer">

												<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

											</div>
										</div>
									</div>
								</div>

								<center>
									<a href="<?= base_url('account/profile#riwayat') ?>" data-toggle="tab" class="btn btn-link">See All Canceled Transaction <br>(total of <?= $cancelled_order->num_rows() ?> cancelled transaction)</a>	
								</center>

							<?php else: ?>

								<center>
									<span>Tidak ada pesanan yang dibatalkan untuk saat ini.</span>
								</center>

							<?php endif; ?>

						<?php endif; ?>

					</div>


					<div class="tab-pane fade" id="riwayat">

						<?php if($user_lvl_name == "Seller"): ?>

							<!-- Penjualan -->
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Penjualan</h6>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<!-- <li><a data-action="reload"></a></li> -->
											<li><a data-action="close"></a></li>
										</ul>
									</div>
								</div>

								<table class="table table-orders-history text-nowrap">
									<thead>
										<tr>
											<th></th>
											<th>Status</th>
											<th>Product name</th>
											<th>Qty</th>
											<th>Kurir</th>
											<th>Resi</th>
											<th>Harga</th>
											<th class="text-center"><i class="icon-arrow-down12"></i></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data_pembelian as $row): ?>
											<?php 
											$cart = unserialize($row->cart); 
											$lasttransid = "";
											$prodcount = 1;
											$showongkir = true;
											$first = true;
											$count_item = $this->M_Index->data_account_countproduct($row->id_shop,$row->id_transaction)->num_rows();
											?>
											<?php foreach ($cart as $items): ?> 
												<?php if(true): ?>
													<?php 
													$data_product = $this->M_Index->data_productedit_getproduct($items['id_prod'])->row();

													$id = $row->id_transaction;

													if($count_item > 1){
														if($count_item > 2){
															if($prodcount == $count_item){
																$showongkir = true;
															}else{
																$prodcount++;
																$showongkir = false;
															}
														}else{
															if($lasttransid != $id && $first == true){
																$first = false;
																$showongkir = false;
															}else if($lasttransid != $id && $first == false){
																$first = true;
																$showongkir = false;
															}else{
																$showongkir = true;
															}
														}
													}

													$lasttransid = $row->id_transaction;
													?>

													<tr>
														<td><?= $row->id_transaction ?></td>
														<td>
															ID Transaksi #<?= $row->id_transaction ?> 
															<?php if($row->status == "Delivered"): ?>
																<div class="text-muted text-size-small">
																	<span class="status-mark bg-success position-left"></span>
																	<?= $row->status ?>
																</div>
															<?php elseif($row->status == "Canceled"): ?>
																<div class="text-muted text-size-small">
																	<span class="status-mark bg-danger position-left"></span>
																	<?= $row->status ?>
																</div>
															<?php elseif($row->status == "On Delivery"): ?>
																<div class="text-muted text-size-small">
																	<span class="status-mark bg-primary position-left"></span>
																	<?= $row->status ?>
																</div>
															<?php elseif($row->status == "Transfer Confirmed By User" || $row->status == "Transfer Received By Admin"): ?>
																<div class="text-muted text-size-small">
																	<span class="status-mark bg-info position-left"></span>
																	<?= $row->status ?>
																</div>
															<?php else: ?>
																<div class="text-muted text-size-small">
																	<span class="status-mark bg-grey position-left"></span>
																	<?= $row->status ?>
																</div>
															<?php endif; ?>
														</td>
														<td>
															<div class="media">
																<a href="#" class="media-left">
																	<img src="<?= base_url($data_product->sampul_path) ?>" height="60" class="" alt="">
																</a>

																<div class="media-body media-middle">
																	<a target="_blank" href="<?= base_url('product/'.$items['id_prod']) ?>" class="text-semibold"><?= $items['name'] ?></a>
																</div>
															</div>
														</td>
														<td><?= $items['qty'] ?></td>
														<td><?= ucfirst($row->kurir) ?> | <?= $row->jenis_paket?></td>
														<td>
															<a href="http://cekresi.com/?noresi=<?= $row->resi ?>" target="_blank"><?= $row->resi ?></a>
														</td>
														<td>
															<?php 
															if(!empty($items['realprice'])){
																$realprice = $items['realprice'];
																$price = $items['price'];
															}else{
																$realprice = $items['price'];
																$price = $items['price'];
															}
															?>
															<h6 class="no-margin text-semibold">
																<?php if($realprice != $price): ?>
																	Rp. <?= number_format($price, 0, ',', '.') ?> <strike style="font-size: 12px !important;">Rp. <?= number_format($realprice, 0, ',', '.') ?></strike>
																<?php else: ?>
																	Rp. <?= number_format($price, 0, ',', '.') ?>
																<?php endif; ?>
															</h6>
														</td>

														<?php if($showongkir): ?>
															<td class="text-center">
																<ul class="icons-list">
																	<li class="dropdown">
																		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
																		<ul class="dropdown-menu dropdown-menu-right">

																			<?php if($row->status == "Pending" || $row->status == "Transfer Confirmed By User"): ?>
																				<li><a data-toggle="modal" data-target="#modal_cancelorder_<?= $row->id_transaction ?>"> Cancel</a></li>
																			<?php else: ?>
																				<li class="disabled"><a> Cancel</a></li>
																			<?php endif; ?>

																			<?php if($row->status == "Transfer Received By Admin"):?>
																				<li><a data-toggle="modal" data-target="#modal_brgdikirim_<?= $row->id_transaction ?>"> Barang Dikirim</a></li>
																			<?php else: ?>
																				<li class="disabled"><a> Barang Dikirim</a></li>
																			<?php endif; ?>



																			<?php if($row->status == "On Delivery"):?>
																				<li><a data-toggle="modal" data-target="#modal_updateresi_<?= $row->id_transaction ?>"> Update Resi</a></li>
																			<?php else: ?>
																				<li class="disabled"><a> Update Resi</a></li>
																			<?php endif; ?>


																			<li><a data-toggle="modal" data-id="<?= $row->id_address ?>" class="open-modal-alamat" href="#modal_alamat"> Alamat Pengiriman</a></li>

																		</ul>
																	</li>
																</ul>
															</td>
														<?php else: ?>
															<td class="text-center"></td>
														<?php endif; ?>
													</tr>	
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>

							<?php foreach ($data_pembelian as $row): ?>
								<?php 
								$cart = unserialize($row->cart); 
								$count_item = $this->M_Index->data_account_countproduct($row->id_shop,$row->id_transaction)->num_rows();
								?>
								<?php foreach ($cart as $items): ?> 
									<div id="modal_alamat" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-info">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h6 class="modal-title">Alamat Pengiriman ID Transaksi #<?= $row->id_transaction ?></h6>
												</div>

												<div class="modal-body">

												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

												</div>


											</div>
										</div>
									</div>

									<div id="modal_cancelorder_<?= $row->id_transaction ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-warning">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Cancel Order</h5>
												</div>

												<form method="post" action="<?php echo base_url('Seller/cancelorder/'.$row->id_transaction.'/'.$count_item);?>">

													<div class="modal-body">
														<p>Apakah anda ingin meng-cancel order?</p>
														<br>
													</div>

													<div class="modal-footer">

														<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-warning">Confirm</button>

													</div>

												</form>

											</div>
										</div>
									</div>

									<div id="modal_brgdikirim_<?= $row->id_transaction ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-info">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Konfirmasi Barang Dikirim</h5>
												</div>

												<form method="post" action="<?php echo base_url('Seller/barangdikirim/'.$row->id_transaction.'/'.$count_item);?>">

													<div class="modal-body">

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
														<button type="submit" class="btn btn-info">Confirm</button>

													</div>

												</form>

											</div>
										</div>
									</div>

									<div id="modal_updateresi_<?= $row->id_transaction ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-info">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Update Resi</h5>
												</div>

												<form method="post" action="<?php echo base_url('Seller/updateresi/'.$row->id_transaction.'/'.$count_item);?>">

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
														<button type="submit" class="btn btn-info">Confirm</button>

													</div>

												</form>

											</div>
										</div>
									</div>

								<?php endforeach; ?>
							<?php endforeach; ?>
							<!-- /Penjualan -->


							<!-- Product -->
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Product</h6>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<!-- <li><a data-action="reload"></a></li> -->
											<li><a data-action="close"></a></li>
										</ul>
									</div>
								</div>

								<table class="table table-product">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>SKU</th>
											<th>Stok</th>
											<th>Harga</th>
											<th>Promo</th>
											<th class="text-center"><i class="icon-arrow-down12"></i></th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 1; ?>
										<?php foreach ($shop_product as $row): ?>

											<?php 
											if($row->promo_aktif == '0'){
												$promo = "Tidak Aktif";
											}else{
												$promo = "Aktif";
											}
											?>

											<tr>
												<td><?= $counter ?></td>	
												<td>
													<div class="media">
														<a href="#" class="media-left">
															<img src="<?= base_url($row->sampul_path) ?>" height="60" class="" alt="">
														</a>

														<div class="media-body media-middle">
															<a target="_blank" href="<?= base_url('product/'.$row->id_product) ?>" class="text-semibold"><?= $row->nama_product ?></a>
														</div>
													</div>
												</td>
												<td><?= $row->sku ?></td>
												<td><?= $row->stok ?></td>
												<td>Rp. <?= number_format($row->harga, 0, ',', '.') ?></td>
												<td><?= $promo ?></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>

															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="<?= base_url('account/product/edit/'.$row->id_product) ?>"><i class="icon-pencil5"></i> Edit</a></li>
																<!-- <li><a href="<?= base_url('Admins/deleteproduct/'.$row->id_product) ?>"><i class="icon-trash-alt"></i> Delete</a></li> -->
																<li><a data-toggle="modal" data-target="#modal_delete_prod_<?= $row->id_product ?>"><i class="icon-trash-alt"></i> Delete</a></li>
															</ul>
														</li>
													</ul>
												</td>


											</tr>	

											<?php $counter++; ?>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>

							<?php foreach ($shop_product as $row): ?>
								<div id="modal_delete_prod_<?= $row->id_product ?>" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-warning">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h5 class="modal-title">Hapus Product</h5>
											</div>

											<div class="modal-body">
												<!-- <h6 class="text-semibold">Text in a modal</h6> -->
												<p>Hapus product <i><?= $row->nama_product ?></i>? <br><b>Anda tidak bisa meng-undo setelah menghapus product tersebut!</b></p>

											</div>

											<div class="modal-footer">

												<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
												<a href="<?= base_url('Seller/deleteproduct/'.$row->id_product) ?>" class="btn btn-warning">Confirm</a>

											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<!-- /Product -->

							<!-- Withdraw -->
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Withdraw</h6>
									<span style="color: red">Harap jangan mengganti no.rekening selama proses pengajuan withdraw saldo</span>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<!-- <li><a data-action="reload"></a></li> -->
											<li><a data-action="close"></a></li>
										</ul>
									</div>
								</div>

								<table class="table table-withdraw">
									<thead>
										<tr>
											<th>#</th>
											<th>Amount</th>
											<th>Date</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 1; ?>
										<?php foreach ($data_withdraw as $row): ?>

											<tr>
												<td><?= $counter ?></td>
												<td>Rp. <?= number_format($row->amount, 0, ',', '.') ?></td>
												<td><?= $row->date ?></td>
												<td><?= $row->status ?></td>
											</tr>	

											<?php $counter++; ?>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>

							<div id="modal_addwithdraw" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header bg-info">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Pengajuan Withdraw</h5>
										</div>
										<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/withdraw/'.$data_user["id_shop"]);?>" enctype='multipart/form-data'>
											<div class="modal-body">

												<div class="form-group">
													<label class="control-label col-lg-2">Jumlah Withdraw</label>
													<div class="col-lg-10">
														<input type="number" class="form-control" placeholder="Masukkan jumlah withdraw yang diinginkan" name="amount">
														<span class="help-block">Saldo anda saat ini: Rp. <?= number_format($user_data->saldo, 0, ',', '.') ?></span>
													</div>
												</div>

												<span style="color: red">*Anda tidak bisa membatalkan setelah melakukan pengajuan withdraw saldo</span>

											</div>

											<div class="modal-footer">

												<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-info" id="btnsubmit">Ajukan</button>

											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Withdraw -->


							<!-- Exceed Delivery -->

							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Pesanan yang perlu dikirim</h6>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<!-- <li><a data-action="reload"></a></li> -->
											<li><a data-action="close"></a></li>
										</ul>
									</div>
								</div>

								<table class="table table-deliveryexceed text-nowrap">
									<thead>
										<tr>
											<th>ID Transaksi</th>
											<th>Seller</th>
											<th>Tanggal Pemesanan</th>
											<th>Jumlah Product</th>
											<th>Jumlah Transfer</th>
											<th class="text-center"><i class="icon-arrow-down12"></i></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data_exceed->result() as $row): ?>

											<tr>
												<td><?= $row->id_transaction ?></td>
												<td><?= $row->username ?></td>
												<td><?= $row->date_ordered ?></td>
												<td><?= count(unserialize($row->cart)) ?></td>
												<?php
												$total = $row->totalharga + $row->totalongkir;
												$total = substr($total, 0, -3).$row->kode_unik;
												?>
												<td>Rp. <?= number_format($total, 0, ',', '.') ?></td>

												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#modal_detailtransaksi" class="text-default open-modal-detailtransaksi" data-toggle="modal" data-id="<?= $row->id_transaction ?>|<?= $row->id_shop ?>"><i class="icon-eye8"></i> Detail transaksi</a></li>
																<li><a data-toggle="modal" class="text-default" data-target="#modal_ship_<?= $row->id_transaction ?>"><i class="icon-truck"></i> Konfirmasi barang dikirim</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
							<!-- /Exceed Delivery -->


						<?php else: ?>
							<!-- Orders history (datatable) -->
							<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Riwayat Pembelian</h6>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<!-- <li><a data-action="reload"></a></li> -->
											<li><a data-action="close"></a></li>
										</ul>
									</div>
								</div>

								<table class="table table-orders-history text-nowrap">
									<thead>
										<tr>
											<th></th>
											<th>Status</th>
											<th>Product name</th>
											<th>Qty</th>
											<th>Kurir</th>
											<th>Resi</th>
											<th>Harga</th>
											<th class="text-center"><i class="icon-arrow-down12"></i></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data_pembelian as $row): ?>
											<?php 
											$cart = unserialize($row->cart); 
											$lasttransid = "";
											$prodcount = 1;
											$showongkir = true;
											$first = true;
											$count_item = $this->M_Index->data_account_countproductnoshop($row->id_transaction)->num_rows();
											?>
											<?php foreach ($cart as $items): ?>
												<?php 
												$data_product = $this->M_Index->data_productedit_getproduct($items['id_prod'])->row();

												$id = $row->id_transaction;

												if($count_item > 1){
													if($count_item > 2){
														if($prodcount == $count_item){
															$showongkir = true;
														}else{
															$prodcount++;
															$showongkir = false;
														}
													}else{
														if($lasttransid != $id && $first == true){
															$first = false;
															$showongkir = false;
														}else if($lasttransid != $id && $first == false){
															$first = true;
															$showongkir = false;
														}else{
															$showongkir = true;
														}
													}
												}

												$lasttransid = $row->id_transaction;
												?>

												<tr>
													<td><?= $row->id_transaction ?></td>
													<td>
														<a target="_blank" href="<?= base_url('order/details/'.$row->id_transaction) ?>">ID Transaksi #<?= $row->id_transaction ?></a>
														<?php if($row->status == "Delivered"): ?>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-success position-left"></span>
																<?= $row->status ?>
															</div>
														<?php elseif($row->status == "Canceled"): ?>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-danger position-left"></span>
																<?= $row->status ?>
															</div>
														<?php elseif($row->status == "On Delivery"): ?>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-primary position-left"></span>
																<?= $row->status ?>
															</div>
														<?php elseif($row->status == "Transfer Confirmed By User" || $row->status == "Transfer Received By Admin"): ?>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-info position-left"></span>
																<?= $row->status ?>
															</div>
														<?php else: ?>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-grey position-left"></span>
																<?= $row->status ?>
															</div>
														<?php endif; ?>
													</td>
													<td>
														<div class="media">
															<a href="#" class="media-left">
																<img src="<?= base_url($data_product->sampul_path) ?>" height="60" class="" alt="">
															</a>

															<div class="media-body media-middle">
																<a target="_blank" href="<?= base_url('product/'.$items['id_prod']) ?>" class="text-semibold"><?= $items['name'] ?></a>
															</div>
														</div>
													</td>
													<td><?= $items['qty'] ?></td>
													<td><?= ucfirst($row->kurir) ?> | <?= $row->jenis_paket?></td>
													<td>
														<a href="http://cekresi.com/?noresi=<?= $row->resi ?>" target="_blank"><?= $row->resi ?></a>
													</td>
													<td>
														<?php 
														if(!empty($items['realprice'])){
															$realprice = $items['realprice'];
															$price = $items['price'];
														}else{
															$realprice = $items['price'];
															$price = $items['price'];
														}
														?>
														<h6 class="no-margin text-semibold">
															<?php if($realprice != $price): ?>
																Rp. <?= number_format($price, 0, ',', '.') ?> <strike style="font-size: 12px !important;">Rp. <?= number_format($realprice, 0, ',', '.') ?></strike>
															<?php else: ?>
																Rp. <?= number_format($price, 0, ',', '.') ?>
															<?php endif; ?>
														</h6>
													</td>

													<?php if($showongkir): ?>
														<td class="text-center">
															<ul class="icons-list">
																<li class="dropdown">
																	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
																	<ul class="dropdown-menu dropdown-menu-right">

																		<?php if($row->status == "Pending"):?>
																			<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>") ?> Konfirmasi Transfer</a></li>
																		<?php else: ?>
																			<li class="disabled"><a> Konfirmasi Transfer</a></li>
																		<?php endif; ?>

																		<?php if($row->status == "On Delivery"):?>
																			<!-- <li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $items['id_prod'] ?>") ?> Barang Diterima</a></li> -->
																		<?php else: ?>
																			<!-- <li class="disabled"><a> Barang Diterima</a></li> -->
																		<?php endif; ?>

																	</ul>
																</li>
															</ul>
														</td>
													<?php else: ?>
														<td class="text-center"></td>
													<?php endif; ?>
												</tr>

											<?php endforeach; ?>



											<!-- barang diterima modal -->
													<!-- <div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $items['id_shop'] ?>" class="modal fade">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-info">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h6 class="modal-title"></h6>
																</div>

																<div class="modal-body">
																	<h6 class="text-semibold">Konfirmasi Barang Diterima</h6>
																	<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
																</div>

																<div class="modal-footer">

																	<?php 
																	$saldo = $row->totalharga + $row->totalongkir;
																	$saldobuyer = substr($saldo, -3);
																	$saldo = substr($saldo, 0, -3) . '000';
																	?>

																	<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
																	<a href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$data_product->id_shop.'/'.$saldo.'/'.$saldobuyer);?>" class="btn btn-info">Konfirmasi</a>
																</div>
															</div>
														</div>
													</div> -->
													<!-- /barang diterima modal -->

												<?php endforeach; ?>

											</tbody>
										</table>
									</div>
									<!-- /orders history (datatable) -->

									<?php foreach($data_pembelian as $row): ?>
										<!-- konfirmasi trf modal -->
										<div id="modal_konftrf_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-info">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h6 class="modal-title"></h6>
													</div>
													<?php $count_item = $this->M_Index->data_account_countproductnoshop($row->id_transaction)->num_rows(); ?>
													<form method="POST" enctype="multipart/form-data" action="<?= base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$data_user["id_user"].'/'.$count_item);?>">
														<div class="modal-body">
															<h6 class="text-semibold">Konfirmasi Transfer Pembayaran</h6>
															<p>Isi form dibawah untuk mengkonfirmasi bahwa anda telah melakukan transfer sehingga pemesanan anda dapat diteruskan untuk proses pengiriman.</p>

															<!-- <p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p> -->
															<!-- <br> -->
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<fieldset class="content-group">
																<legend class="text-bold">Konfirmasi Transfer</legend>


																<div class="form-group">
																	<label class="control-label col-lg-3">Atas Nama</label>
																	<div class="col-lg-7">
																		<input type="text" class="form-control" name="atasnama">
																	</div>
																</div>
																<br>
																<div class="form-group">
																	<label class="control-label col-lg-3">No. Rekening</label>
																	<div class="col-lg-7">
																		<input type="number" class="form-control" name="norekening">
																	</div>
																</div>
																<br>
																<div class="form-group">
																	<label class="control-label col-lg-3">From Bank</label>
																	<div class="col-lg-7">
																		<input type="text" class="form-control" name="frombank">
																	</div>
																</div>
																<br>
																<div class="form-group">
																	<label class="control-label col-lg-3">Ke Bank</label>
																	<div class="col-lg-7">
																		<select name="select_bank" class="form-control">
																			<?php foreach($data_bank as $roww): ?>
																				<option value="<?= $roww->id_bank ?>"><?= $roww->nama_bank ?></option>	
																			<?php endforeach; ?>
																		</select>
																	</div>
																</div>
																<br><br>
																<div class="form-group">
																	<label class="control-label col-lg-3">Bukti Transfer</label>
																	<div class="col-lg-7">
																		<!-- <label class="display-block">Upload profile image</label> -->
																		<input type="file" class="file-styled" name="bukti_trf">
																		<span class="help-block">Accepted formats: gif, png, jpg. Max file size 1Mb</span>
																	</div>
																</div>
															</fieldset>
														</div>

														<div class="modal-footer">
															<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
															<button type="submit" class="btn btn-info">Konfirmasi</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!-- /konfirmasi trf modal -->
									<?php endforeach; ?>


									<!-- Orders history (datatable) -->
									<div class="panel panel-white">
										<div class="panel-heading">
											<h6 class="panel-title">Pesanan yang dibatalkan</h6>
											<div class="heading-elements">
												<ul class="icons-list">
													<li><a data-action="collapse"></a></li>
													<!-- <li><a data-action="reload"></a></li> -->
													<li><a data-action="close"></a></li>
												</ul>
											</div>
										</div>

										<table class="table table-orders-cancelled text-nowrap">
											<thead>
												<tr>
													<th>ID Transaksi</th>
													<th>Seller</th>
													<th>Tanggal Pemesanan</th>
													<th>Jumlah Product</th>
													<th>Jumlah Transfer</th>
													<th class="text-center"><i class="icon-arrow-down12"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($cancelled_order->result() as $row): ?>

													<tr>
														<td><?= $row->id_transaction ?></td>
														<td><?= $row->username ?></td>
														<td><?= $row->date_ordered ?></td>
														<td><?= count(unserialize($row->cart)) ?></td>
														<td>Rp. <?= number_format($row->total, 0, ',', '.') ?></td>

														<td class="text-center">
															<a href="#modal_detailtransaksi" class="text-default open-modal-detailtransaksi" data-toggle="modal" data-id="<?= $row->id_transaction ?>|<?= $row->id_shop ?>"><i class="icon-eye8"></i></a>
														</td>
													</tr>

												<?php endforeach; ?>

											</tbody>
										</table>
									</div>
									<!-- /orders history (datatable) -->

								<?php endif; ?>

							</div>


							<div class="tab-pane fade" id="pengaturan">
								<?php if($user_lvl_name == "Seller"): ?>

									<!-- Shop Settings -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h6 class="panel-title">Shop Settings &nbsp; <i class="icon-store2"></i></h6>
											<div class="heading-elements">
												<ul class="icons-list">
													<li><a data-action="collapse"></a></li>
													<!-- <li><a data-action="reload"></a></li> -->
													<li><a data-action="close"></a></li>
												</ul>
											</div>
										</div>

										<div class="panel-body">
											<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/edittoko/'.$data_shop->id_shop);?>">
												<div class="form-group">
													<div class="row">
														<div class="col-lg-2">
															<div class="checkbox checkbox-right">
																<label>
																	<?php if($data_shop->toko_buka == "1"): ?>
																		<input type="checkbox" class="styled" checked="checked" name="toko_buka">
																	<?php else: ?>
																		<input type="checkbox" class="styled" name="toko_buka">
																	<?php endif ?>
																	Toko Buka
																</label>
															</div>
														</div>
													</div>
												</div>

												<?php
												$kurir = explode(',',$data_shop->kurir);
												?> 
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Kota Asal Toko</label>
															<select name="kota_asal" class="select">
																<?php
																for ($i=0; $i < count($rajaongkir_kota['rajaongkir']['results']); $i++) { 
																	if($data['rajaongkir']['results'][$i]['city_id'] == $data_shop->kota_asal){
																		echo "<option value='".$rajaongkir_kota['rajaongkir']['results'][$i]['city_id']."' selected>".$rajaongkir_kota['rajaongkir']['results'][$i]['city_name']."</option>";
																	}else{
																		echo "<option value='".$rajaongkir_kota['rajaongkir']['results'][$i]['city_id']."'>".$rajaongkir_kota['rajaongkir']['results'][$i]['city_name']."</option>";
																	}

																}
																?>			
															</select>
														</div>
														<div class="col-md-6">
															<label>Jasa Pengiriman Yang Digunakan</label>
															<div class="checkbox">
																<?php if((!empty($kurir[0]) && $kurir[0] == 'jne')|| (!empty($kurir[1]) && $kurir[1] == 'jne') || (!empty($kurir[2]) && $kurir[2] == 'jne') || (!empty($kurir[3]) && $kurir[3] == 'jne')): ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" checked name="jne">
																		JNE
																	</label>

																<?php else: ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" name="jne">
																		JNE
																	</label>
																<?php endif; ?>


																<?php if((!empty($kurir[0]) && $kurir[0] == 'tiki')|| (!empty($kurir[1]) && $kurir[1] == 'tiki') || (!empty($kurir[2]) && $kurir[2] == 'tiki') || (!empty($kurir[3]) && $kurir[3] == 'tiki')): ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" checked name="tiki">
																		TIKI
																	</label>

																<?php else: ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" name="tiki">
																		TIKI
																	</label>
																<?php endif; ?>

																<?php if((!empty($kurir[0]) && $kurir[0] == 'pos')|| (!empty($kurir[1]) && $kurir[1] == 'pos') || (!empty($kurir[2]) && $kurir[2] == 'pos') || (!empty($kurir[3]) && $kurir[3] == 'pos')): ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" checked name="pos">
																		POS INDONESIA
																	</label>

																<?php else: ?>
																	<label class="checkbox-inline">
																		<input type="checkbox" class="styled" name="pos">
																		POS INDONESIA
																	</label>
																<?php endif; ?>
															</div>
														</div>
													</div>
												</div>


												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Bank</label>
															<input type="text" class="form-control" value="<?= $data_shop->bank ?>" name="bank">
														</div>

														<div class="col-md-6">
															<label>No. Rekening</label>
															<input type="text" class="form-control" value="<?= $data_shop->rekening ?>" name="rekening">
														</div>
													</div>
												</div>

												<div class="text-right">
													<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
												</div>
											</form>
										</div>
									</div>
									<!-- /Shop Settings -->

								<?php else: ?>
									<!-- Alamat -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h5 class="panel-title">Alamat Pengiriman</h5>
											<div class="heading-elements">
												<ul class="icons-list">
													<li><a data-action="collapse"></a></li>
													<!-- <li><a data-action="reload"></a></li> -->
													<li><a data-action="close"></a></li>
												</ul>
											</div>
										</div>



										<table class="table table-alamat text-nowrap">
											<thead>
												<tr>
													<th width="30">No.</th>
													<th>Alamat</th>
													<th>Atas Nama</th>
													<th>Telephone</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach($data_alamat as $row): ?>
													<tr>
														<td><?= $i ?></td>
														<td><?= $row->alamat ?></td>
														<td><?= $row->atasnama ?></td>
														<td><?= $row->telephone ?></td>
														<td class="text-center">
															<a href="<?= base_url('account/alamat/edit/'.$row->id_address) ?>" class="btn btn-primary btn-icon btn-rounded"><i class="icon-pencil5"></i></a>

															<button type="button" class="btn btn-danger btn-icon btn-rounded btn-sm"  data-toggle="modal" data-target="#modal_delete_alamat_<?= $row->id_address ?>"><i class="icon-trash-alt"></i></button>
														</td>
													</tr>

													<?php $i++; ?>
												<?php endforeach; ?>



											</tbody>
										</table>
									</div>

									<?php foreach($data_alamat as $row): ?>
										<!-- Delete alamat modal -->
										<div id="modal_delete_alamat_<?= $row->id_address ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-warning">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h6 class="modal-title"></h6>
													</div>

													<div class="modal-body">
														<h6 class="text-semibold">Hapus Alamat</h6>
														<p>Apakah anda yakin ingin menghapus alamat <mark><?= $row->alamat ?></mark> ? Jika telah dihapus maka alamat tersebut tidak dapat dikembalikan lagi, dan jika ingin ditambahkan kembali harus ditambahkan secara manual.</p>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
														<a href="<?= base_url('Address/delete/'.$row->id_address) ?>" class="btn btn-warning">Hapus</a>
													</div>
												</div>
											</div>
										</div>
										<!-- /delete alamat modal -->
									<?php endforeach; ?>
									<!-- /Alamat -->
								<?php endif; ?>

								<!-- Account Settings -->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h6 class="panel-title">Account Settings &nbsp; <i class="icon-profile"></i></h6>
										<div class="heading-elements">
											<ul class="icons-list">
												<li><a data-action="collapse"></a></li>
												<!-- <li><a data-action="reload"></a></li> -->
												<li><a data-action="close"></a></li>
											</ul>
										</div>
									</div>

									<div class="panel-body">
										<form method="post" action="<?= base_url('Account/editaccount') ?>" enctype='multipart/form-data'>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>First Name</label>
														<input type="text" value="<?= $user_data->first_name ?>" class="form-control" name="first_name">
													</div>

													<div class="col-md-6">
														<label>Last Name</label>
														<input type="text" value="<?= $user_data->last_name ?>" class="form-control" name="last_name">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>Telephone</label>
														<input type="text" value="<?= $user_data->telephone ?>" class="form-control" name="telephone">
														<span class="help-block"><?= $user_data->telephone ?></span>
													</div>

													<div class="col-md-6">
														<label>E-mail</label>
														<input type="email" value="<?= $user_data->email ?>" class="form-control" name="email">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>Username</label>
														<input type="text" value="<?= $user_data->username ?>" readonly="readonly" class="form-control" name="username">
													</div>

													<div class="col-md-6">
														<label>Current password</label>
														<input type="password" value="password" readonly="readonly" class="form-control">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>New password</label>
														<input type="password" placeholder="Enter new password" class="form-control" name="new_pwd">
													</div>

													<div class="col-md-6">
														<label>Repeat password</label>
														<input type="password" placeholder="Repeat new password" class="form-control" name="new_pwd_confirm">
													</div>
												</div>
											</div>


											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label class="display-block">Upload profile image</label>
														<input type="file" class="file-styled" name="avatar">
														<span class="help-block">Accepted formats: gif, png, jpg. Max file size 1Mb</span>
													</div>
													<div class="col-md-6">
														<label class="display-block">Upload cover image</label>
														<input type="file" class="file-styled" name="cover">
														<span class="help-block">Accepted formats: gif, png, jpg. Max file size 3Mb</span>
													</div>
												</div>
											</div>

											<label class="left">
												<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
											</label>

											<div class="text-right">
												<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</form>
									</div>
								</div>
								<!-- /Account Settings -->

							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3">

					<!-- User thumbnail -->
					<div class="thumbnail">
						<div class="thumb thumb-slide">
							<img src="<?= base_url($data_user['ava_path']) ?>" alt="">

						</div>

						<div class="caption text-center">
							<h6 class="text-semibold no-margin">
								<?= $data_user["nama_lgkp"] ?>
								<small class="display-block"><?= $user_lvl_name ?></small>
								<small class="display-block">Rp. <?= number_format($user_data->saldo, 0, ',', '.') ?></small>
							</h6>

						</div>
					</div>
					<!-- /user thumbnail -->


					<!-- Navigation -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Navigation</h6>
						</div>

						<div class="list-group no-border no-padding-top">
							<a href="<?= base_url('account/profile') ?>" class="list-group-item" data-toggle="tab"><i class="icon-user"></i> My profile</a>
							<?php if($user_lvl_name == "Seller"): ?>
								<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item" data-toggle="tab"><i class="icon-cash3"></i> Riwayat saldo</a>
							<?php endif; ?>
							<a href="<?= base_url('account/messages') ?>" class="list-group-item"><i class="icon-bubbles7"></i> Pesan</a>
							<?php if($user_lvl_name == "Seller"): ?>
								<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" data-toggle="tab"><i class="icon-store2"></i> Toko </a>
							<?php else: ?>
								<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" data-toggle="tab"><i class="icon-location4"></i> Alamat </a>
							<?php endif; ?>

							<?php if($user_lvl_name == "Seller"): ?>
								<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item" data-toggle="tab"><i class="icon-stack2"></i> Penjualan</a>
							<?php else: ?>
								<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item" data-toggle="tab"><i class="icon-stack2"></i> Pembelian</a>
							<?php endif; ?>

							<?php if($user_lvl_name != "Seller"): ?>

								<div class="list-group-divider"></div>

								<a data-toggle="modal" class="list-group-item" data-target="#modal_req_seller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Seller</span></a>

								<a data-toggle="modal" class="list-group-item" data-target="#modal_req_reseller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Re-seller</span></a>

								<div class="list-group-divider"></div>

							<?php endif; ?>

							<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" data-toggle="tab"><i class="icon-cog3"></i> Pengaturan akun</a>
						</div>
					</div>
					<!-- /navigation -->




					<?php if($user_lvl_name == "Seller"): ?>
						<!-- Balance chart -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Pengeluaran / Pemasukan Saldo</h6>
							</div>

							<div class="panel-body">
								<div class="chart-container">
									<div class="chart" id="visits" style="height: 300px;"></div>
								</div>
							</div>
						</div>
						<!-- /balance chart -->
					<?php endif; ?>


					<!-- Connections -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Latest connections</h6>
						</div>

						<ul class="media-list media-list-linked pb-5">
							<?php $counter = 1; ?>
							<?php foreach($data_msg as $row): ?>

								<?php if($counter <= 5): ?>

									<?php 
									if($row->id_user == $data_user["id_user"]){
										$connection_detail = $this->M_Index->data_order_getuser($row->id_receiver)->row();
									}else{
										$connection_detail = $this->M_Index->data_order_getuser($row->id_user)->row();
									}
									$counter++;
									?>

									<li class="media">
										<a href="<?= base_url('account/messages/convo/'.$row->id_convo) ?>" class="media-link">
											<div class="media-left"><img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt=""></div>
											<div class="media-body">
												<span class="media-heading text-semibold"><?= $connection_detail->username ?></span>
												<span class="text-muted" style="white-space: nowrap; text-overflow: ellipsis; width: 200px; display: block; overflow: hidden"><?= $row->msg ?></span>
											</div>
										</a>
									</li>

								<?php endif; ?>

							<?php endforeach; ?>
						</ul>
					</div>
					<!-- /connections -->

				</div>
			</div>
			<!-- /user profile -->


		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
