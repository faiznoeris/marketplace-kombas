<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">




		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Delivered Exceed Deadline</b></h5>
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
					Pada tabel dibawah anda dapat melakukan konfirmasi barang diterima secara manual namun diharapkan untuk mengecek status pengiriman transaksi terlebih dahulu dengan menggunakan resi yang tertera pada tabel dibawah.
				</div>

				<table class="table table-orders-history text-nowrap">
					<thead>
						<tr>
							<th></th>
							<th>Status</th>
							<th>Product name</th>
							<th>Tanggal Pengiriman</th>
							<th>RESI Pengiriman</th>
							<th>Total Transfer</th>
							<th class="text-center"><i class="icon-arrow-down12"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_exceed as $key => $row): ?>
							<?php 
							date_default_timezone_set('Asia/Jakarta'); //set timezone to jakarta
							$datenow = date('Y-m-d');

							$datetime1 = new DateTime($row->date_delivered);
							$datetime2 = new DateTime($datenow);

							$interval = $datetime1->diff($datetime2);

							$daydistance = $interval->format('%a');
							?>
							<?php if($daydistance > 5 && $row->status == "On Delivery"): ?>
								<?php
								$cart = unserialize($row->cart); 
								$lasttransid = "";
								$prodcount = 1;
								$showongkir = true;
								$first = true;
								$count_item = $this->M_transaction_history_product->select("transaction",$row->id_transaction)->num_rows();
								?>
								<?php foreach ($cart as $items): ?>
									<?php 
									$data_product = $this->M_products->getproduct($items['id_prod'])->row();

									$id = $row->id_transaction;


									if($count_item > 1){
										if($count_item == 2){
											if($lasttransid != $id && $first == true){
												$first = false;
												$showongkir = false;
											}else if($lasttransid != $id && $first == false){
												$first = true;
												$showongkir = false;
											}else{
												$showongkir = true;
											}
										}else if($count_item > 2){
											if($prodcount == $count_item){
												$showongkir = true;
											}else{
												$prodcount++;
												$showongkir = false;
											}
										}
									}



									$lasttransid = $row->id_transaction;
									?>

									<tr>
										<?php if($showongkir): ?>
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
											<td><?= $row->date_ordered ?></td>
											<td style="display: none"></td>
											<td>
												<a href="http://cekresi.com/?noresi=<?= $row->resi ?>" target="_blank"><?= $row->resi ?></a>
											</td>
											<td>
												<h6 class="no-margin text-semibold">Rp. <?= number_format($row->totalprice, 0, ',', '.') ?></h6>
											</td>

											<?php if($row->status == "On Delivery"):?>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">

																<?php if($row->status == "On Delivery"):?>
																	<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>") ?> Barang Diterima</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Barang Diterima</a></li>
																<?php endif; ?>

															</ul>
														</li>
													</ul>
												</td>
											<?php else: ?>
												<td></td>
											<?php endif; ?>
										<?php else: ?>
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
											<td class="text-center"></td>
											<td class="text-center" style="display: none !important;"></td>
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

					$datetime1 = new DateTime($row->date_delivered);
					$datetime2 = new DateTime($datenow);

					$interval = $datetime1->diff($datetime2);

					$daydistance = $interval->format('%a');
					?>
					<?php if($daydistance > 5 && $row->status == "On Delivery"): ?>
						<!-- confirm received modal -->
						<div id="modal_brgditerima_<?= $row->id_transaction ?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-info">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h6 class="modal-title"></h6>
									</div>

									<div class="modal-body">
										<h6 class="text-semibold">Konfirmasi Barang Diterima - ID Transaksi #<?= $row->id_transaction ?></h6>
										<p>Apakah anda yakin untuk mengkonfirmasai barang telah diterima secara manual? <br><strong>Pastikan anda telah mengecek resi dari transaksi yang ingin dikonfirmasi secara manual bahwa barang telah sampai ke pembeli</strong>.</p>
									</div>

									<?php 
									$saldo = $row->totalprice;
									$saldobuyer = substr($saldo, -3);
									$saldo = substr($saldo, 0, -3) . '000';
									?>

									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<a class="btn btn-info" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$row->id_shop.'/'.$saldo.'/'.$saldobuyer.'/admin/'.$row->id_user);?>">Konfirmasi</a>
									</div>
								</div>
							</div>
						</div>
						<!-- /confirm received modal -->
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