<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">

		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Delivery Exceed Deadline</b></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>


			<!-- Orders history (datatable) -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title">Data Transaksi</h6>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="reload"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
					Pada tabel dibawah terdapat kumpulan data transaksi yang melebihi batas waktu pengiriman ketika pembeli sudah melakukan pembayaran. Anda dapat memberi peringatan kepada seller untuk melakukan pengiriman pada tabel dibawah.
				</div>

				<table class="table table-orders-history text-nowrap">
					<thead>
						<tr>
							<th></th>
							<th>Status</th>
							<th>Product name</th>
							<th>Tanggal Pemesanan</th>
							<th>Kurir</th>
							<th style="display: none !important;"></th>
							<th>Total Transfer</th>
							<th class="text-center"><i class="icon-arrow-down12"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						function sortByName($a, $b)
						{
							$a = $a['id_shop'];
							$b = $b['id_shop'];

							if ($a == $b) return 0;
							return ($a < $b) ? -1 : 1;
						}
						?>
						<?php foreach ($data_exceed as $row): ?>
							<?php 
							date_default_timezone_set('Asia/Jakarta'); //set timezone to jakarta
							$datenow = date('Y-m-d');

							$datetime1 = new DateTime($row->date_ordered);
							$datetime2 = new DateTime($datenow);

							$interval = $datetime1->diff($datetime2);

							$daydistance = $interval->format('%a');
							?>
							<?php if($daydistance > 5 && $row->status == "Pending" && $row->status != "Canceled"): ?>
								<?php 
								$cart = unserialize($row->cart); 
								$lasttransid = "";
								$lastseller = "";
								$prodcount = 1;
								$showongkir = true;
								$first = true;
								$count_item = $this->M_Index->data_account_countproductnoshop($row->id_transaction)->num_rows();

								$shops = explode(',', $row->id_shop); 
								$index = array_search('', $shops); 
								if ( $index !== false ) {
									unset( $shops[$index] );
								}
								$shops = count($shops);

								usort($cart, 'sortByName');
								array_reverse($cart);
								?>
								<?php foreach ($cart as $key => $items): ?>
									<?php 
									$data_product = $this->M_Index->data_productedit_getproduct($items['id_prod'])->row();
									$data_shop = $this->M_Index->data_productview_getshop($items['id_shop'])->row();
									$data_seller = $this->M_Index->data_productview_getuser($data_shop->id_user)->row();

									$id = $row->id_transaction;

									if($shops > 1){

										$showongkir = false;
										if($lastseller == $data_seller->username && $first == false){
											if($count_item == $prodcount){
												$showongkir = true;
											}else{
												$showongkir = false;
											}
										}else if($lastseller != $data_seller->username && $first == false){

											if($count_item == $prodcount){
												$showongkir = true;

											}else if(isset($cart[$key+1]['id_shop'])){ //check next seller in loop
												$data_shop_2 = $this->M_shop->selectidshop($cart[$key+1]['id_shop'])->row();
												$data_seller_2 = $this->M_users->select($data_shop_2->id_user)->row();

												if($data_seller->username == $data_seller_2->username){
													$showongkir = false;
												}else{
													$showongkir = true;
												}
											}

										}else if($lastseller != $data_seller->username && $first == true){
											
										if(isset($cart[$key+1]['id_shop'])){ //check next seller in loop
											$data_shop_2 = $this->M_Index->data_productview_getshop($cart[$key+1]['id_shop'])->row();
											$data_seller_2 = $this->M_Index->data_productview_getuser($data_shop_2->id_user)->row();

											if($data_seller->username == $data_seller_2->username){
												$showongkir = false;
											}else{
												$showongkir = true;
											}
										}
										
									}
									
								}

								$lastseller = $data_seller->username;
								$lasttransid = $row->id_transaction;
								$first = false;
								$prodcount++;
								?>

								<tr>
									<?php if($showongkir): ?>
										<td><?= $row->id_transaction ?></td>
										<td>
											ID Transaksi #<?= $row->id_transaction ?> -  <?= $data_seller->username ?>
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
										<td><?= $row->date_ordered ?></td>
										<td><?= ucfirst($row->kurir) ?> | <?= $row->jenis_paket?></td>
										<td class="text-center" style="display: none !important;"></td>
										<td>
											<h6 class="no-margin text-semibold">Rp. <?= number_format($row->totalprice, 0, ',', '.') ?></h6>
										</td>

										<?php if($row->warning == "0"):?>
											<td class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<ul class="dropdown-menu dropdown-menu-right">

															<?php if($row->warning == "0"):?>
																<li><a data-toggle="modal" data-target="#modal_warnseller_<?= $row->id_transaction ?>_<?= $items['id_shop'] ?>") ?> Warn Seller</a></li>
															<?php else: ?>
																<li class="disabled"><a> Warn Seller</a></li>
															<?php endif; ?>

														</ul>
													</li>
												</ul>
											</td>
										<?php else: ?>
											<td class="text-center"></td>
										<?php endif; ?>
									<?php else: ?>
										<td><?= $row->id_transaction ?></td>
										<td>
											ID Transaksi #<?= $row->id_transaction ?> -  <?= $data_seller->username ?>
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
										<td class="text-center" style="display: none !important;"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
									<?php endif; ?>
								</tr>

								

							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>

				</tbody>
			</table>

			<?php foreach($data_exceed as $row): ?>
				<?php 
				date_default_timezone_set('Asia/Jakarta'); //set timezone to jakarta
				$datenow = date('Y-m-d');

				$datetime1 = new DateTime($row->date_ordered);
				$datetime2 = new DateTime($datenow);

				$interval = $datetime1->diff($datetime2);

				$daydistance = $interval->format('%a');
				?>
				<?php if($daydistance > 5 && $row->status == "Pending" && $row->status != "Canceled" && $row->warning != "1"): ?>
					<?php foreach ($cart as $key => $items): ?>
						<?php if($row->warning == "0"): ?>
							<!-- warn seller trf modal -->
							<div id="modal_warnseller_<?= $row->id_transaction ?>_<?= $items['id_shop'] ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header bg-info">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h6 class="modal-title"></h6>
										</div>

										<div class="modal-body">
											<h6 class="text-semibold">Peringkatan Seller - ID Transaksi #<?= $row->id_transaction ?> | SHOP ID <?= $items['id_shop'] ?></h6>
											<p>Apakah anda yakin untuk memberi peringatan kepada seller untuk mengirim barang karena sudah melebihi waktu batas pengiriman barang.</p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
											<a class="btn btn-info" href="<?php echo base_url('Admins/warnseller/'.$row->id_transaction.'/'.$items['id_shop']);?>">Konfirmasi</a>
										</div>
									</div>
								</div>
							</div>
							<!-- /warn seller modal -->
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>

		</div>
		<!-- /orders history (datatable) -->

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