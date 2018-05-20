<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Transfer Confirmation Report</b></h5>
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
					Tabel dibawah berisi data-data transaksi yang transfernya telah dikonfirmasi oleh pembeli dan perlu ditindak lanjuti oleh Admin untuk dapat diproses lebih lanjut (ke pengiriman).
				</div>

				<table class="table table-orders-history text-nowrap">
					<thead>
						<tr>
							<th></th>
							<th>Status</th>
							<th>Product name</th>
							<th>Tanggal Pemesanan</th>
							<th>Seller</th>
							<th>Total Transfer</th>
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
							$jmlproduk = $this->M_Index_Dashboard->data_admin_sellerhistorynoshop($row->id_transaction)->num_rows();
							// $prod_detail = $this->M_products->getproduct($row->id_product)->row();
							// $history_product = $this->M_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();
							// $history_seller = $this->M_transaction_history_seller->select2('transaction','shop',$row->id_transaction,$prod_detail->id_shop)->row();
							$history = $this->M_Index_Dashboard->data_admin_historydetail($row->id_transaction)->row();


							?>
							<?php foreach ($cart as $items): ?>
								<?php 
								$id_user = $this->M_Index->data_productview_getshop($items['id_shop'])->row()->id_user;
								$seller_detail = $this->M_Index->data_productview_getuser($id_user)->row();	
								$buyer_detail = $this->M_Index->data_productview_getuser($history->id_user)->row();

								$data_product = $this->M_Index->data_productedit_getproduct($items['id_prod'])->row();

								$history_seller = $this->M_Index_Dashboard->data_admin_sellerhistory($row->id_transaction,$items['id_shop'])->row();

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
											ID Transaksi #<?= $row->id_transaction ?> | Buyer: <?= $buyer_detail->username ?>
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
										<td><?= $seller_detail->username ?></td>
										<td>
											<h6 class="no-margin text-semibold">Rp. <?= number_format($row->totalprice, 0, ',', '.') ?></h6>
										</td>
										<?php //if($history_seller->status == "Transfer Confirmed By User"):?>
										<?php if($row->status == "Transfer Confirmed By User"):?>
											<td class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<ul class="dropdown-menu dropdown-menu-right">

															<?php if($history_seller->status == "Transfer Confirmed By User"):?>
																<li><a data-toggle="modal" data-target="#modal_acctrf_<?= $row->id_transaction ?>") ?> Transfer Received</a></li>
															<?php else: ?>
																<li class="disabled"><a> Transfer Received</a></li>
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
											ID Transaksi #<?= $row->id_transaction ?> | Buyer: <?= $buyer_detail->username ?>
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
										<td><?= $seller_detail->username ?></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
									<?php endif; ?>
								</tr>

							<?php endforeach; ?>

							
						<?php endforeach; ?>

					</tbody>
				</table>
				<?php foreach($data_pembelian as $row): ?>
					<?php
					$history =  $this->M_Index_Dashboard->data_admin_historydetail($row->id_transaction)->row();
					$buyer_detail = $this->M_Index->data_order_getuser($history->id_user)->row();
					// $prod_detail = $this->M_products->getproduct($row->id_product)->row();
					?>
					<!-- konfirmasi trf modal -->
					<div id="modal_acctrf_<?= $row->id_transaction ?>" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-info">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h6 class="modal-title"></h6>
								</div>

								<div class="modal-body">
									<h6 class="text-semibold">Konfirmasi Transfer Pembayaran | ID Transaksi #<?= $row->id_transaction ?> </h6>
									<fieldset>
										<?php 
										$data_konf = $this->M_Index_Dashboard->data_confirmation($row->id_transaction,$buyer_detail->id_user)->row();
										$bank = $this->M_Index_Dashboard->get_bank($data_konf->id_bank)->row()->nama_bank;
										?>
										Buyer: <i><b><?= $buyer_detail->username ?></b></i><br>
										Atas Nama: <i><b><?= $data_konf->atasnama ?></b></i><br>
										No. Rekening: <i><b><?= $data_konf->no_rekening ?></b></i><br>
										From Bank: <i><b><?= $data_konf->from_bank ?></b></i><br>
										To Bank: <i><b><?= $bank ?></b></i><br>
										Nominal: <i><b>Rp. <?= number_format($row->totalharga + $row->totalongkir, 0, ',', '.') ?></b></i><br>
										Bukti Transfer: <br><img src='<?= base_url($data_konf->bukti_path) ?>' height="550" width="550"/> 

									</fieldset>
									<br>
									<p>Isi form dibawah untuk mengkonfirmasi bahwa anda telah melakukan transfer sehingga pemesanan anda dapat diteruskan untuk proses pengiriman.</p>

								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
									<!-- <a class="btn btn-info" href="<?php echo base_url('Admins/acctransfer/'.$row->id_transaction.'/'.$buyer_detail->id_user.'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>">Konfirmasi</a> -->
									<a class="btn btn-info" href="<?php echo base_url('Admins/acctransfer/'.$row->id_transaction.'/'.$buyer_detail->id_user.'/'.$jmlproduk);?>">Konfirmasi</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /konfirmasi trf modal -->
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