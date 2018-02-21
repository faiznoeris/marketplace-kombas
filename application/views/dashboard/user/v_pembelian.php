<div id="jGrowl-pembelian-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Basic modal -->
<div id="modal_req_seller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradeseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Basic modal -->
<div id="modal_req_reseller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradereseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->

<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pembelian</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Pembelian</li>
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
						<th width="3%">Id Transaksi</th>
						<th>Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Kurir & Paket</th>
						<th>Status</th>
						<th>Resi</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $firstt = true; $counter = 1; $id_transbefore = '';?>

					<?php

					$prodcount = array();
					$pertama = true;

					foreach($data_jmlproduk as $row){

						$prodcount[$row->id_transaction] = $row->id_product;
						
					}

					// foreach($data_pembelian as $row){

					// 	$prodcount .= $row->id_product;
					// }
					// print_r($prodcount);

					?>

					<?php foreach ($data_pembelian as $row): ?>

						<?php

						$dontcount = false;

						$prods = explode(',', $row->id_product);  

						//removing whitespace and counting how many product & shop
						$index_prod = array_search('', $prods); 
						if ( $index_prod !== false ) {
							unset( $prods[$index_prod] );
						}

						$totprods = explode(',', $prodcount[$row->id_transaction]);  

						//removing whitespace and counting how many product & shop
						$index_totprod = array_search('', $totprods); 
						if ( $index_totprod !== false ) {
							unset( $totprods[$index_totprod] );
						}

						$jmlproduk = $this->m_transaction_history_seller->select('transaction',$row->id_transaction)->num_rows();
						// $jmlproduk2 = $this->m_transaction_history_seller->select2('transaction','shop',$row->id_transaction,$row->id_shop)->num_rows();




						?>

						<?php if(count($prods) < 2): ?>

							<?php 

							$prod_detail = $this->m_products->getproduct($row->id_product)->row();
							$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();
							$history_seller = $this->m_transaction_history_seller->select2('transaction','shop',$row->id_transaction,$prod_detail->id_shop)->row();

							?>

							<?php if($jmlproduk > 1): ?>

								<?php if($id_transbefore != $row->id_transaction){$firstt=true;} ?>

								<?php if($firstt): ?>

									<tr>
										<td><?= $counter ?></td>
										<td rowspan="<?= count($totprods) ?>"><a href="<?= base_url('order/details/'.$row->id_transaction) ?>"><?= $row->id_transaction ?> (Click for order details)</a></td>
										<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
										<td><?= $history_product->qty ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
										<td><?= $history_seller->status ?></td>
										<td><a href="http://cekresi.com/?noresi=<?= $history_seller->resi ?>" target="_blank"><?= $history_seller->resi ?></a></td>
										<?php if($history_seller->status == "Pending" || $history_seller->status == "On Delivery"):?>
											<td class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right">

															<?php if($history_seller->status == "Pending"):?>
																<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Konfirmasi Transfer</a></li>
															<?php else: ?>
																<li class="disabled"><a> Konfirmasi Transfer</a></li>
															<?php endif; ?>

															<?php if($history_seller->status == "On Delivery"):?>
																<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
															<?php else: ?>
																<li class="disabled"><a> Barang Diterima</a></li>
															<?php endif; ?>

														</ul>
													</li>
												</ul>
											</td>
										<?php else: ?>
											<td class="text-center">
												
											</td>
										<?php endif; ?>

										<!-- Basic modal -->
										<div id="modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Konfirmasi Transfer</h5>
													</div>

													<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$session["id_user"].'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>" enctype='multipart/form-data'>

														<div class="modal-body">
															<p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p>
															<br>
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
																		<input type="file" class="file-styled" name="bukti_trf">
																	</div>
																</div>
															</fieldset>


														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary"> Confirm</a>

															</div>

														</form>

													</div>
												</div>
											</div>

											<div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
														</div>


														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
															<br>
														</div>

														<div class="modal-footer">

															<?php 
															$saldo = $row->totalharga + $row->totalongkir;
															$saldobuyer = substr($saldo, -3);
															$saldo = substr($saldo, 0, -3) . '000';
															?>

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop.'/'.$saldo.'/'.$saldobuyer);?>"> Confirm</a>

														</div>

													</div>
												</div>
											</div>

										</tr>

										<?php $firstt = false; ?>

									<?php else: ?>

										<tr>
											<td><?= $counter ?></td>
											<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
											<td><?= $history_product->qty ?></td>
											<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
											<td><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
											<td><?= $history_seller->status ?></td>
											<td><a href="http://cekresi.com/?noresi=<?= $history_seller->resi ?>" target="_blank"><?= $history_seller->resi ?></a></td>
											<?php if($history_seller->status == "Pending" || $history_seller->status == "On Delivery"):?>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>

															<ul class="dropdown-menu dropdown-menu-right">

																<?php if($history_seller->status == "Pending"):?>
																	<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Konfirmasi Transfer</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Konfirmasi Transfer</a></li>
																<?php endif; ?>

																<?php if($history_seller->status == "On Delivery"):?>
																	<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Barang Diterima</a></li>
																<?php endif; ?>

															</ul>
														</li>
													</ul>
												</td>
											<?php else: ?>
												<td class="text-center">

												</td>
											<?php endif; ?>
											<td style="display: none"></td>

											<!-- Basic modal -->
											<div id="modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h5 class="modal-title">Konfirmasi Transfer</h5>
														</div>

														<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$session["id_user"].'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>" enctype='multipart/form-data'>

															<div class="modal-body">
																<p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p>
																<br>
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
																			<input type="file" class="file-styled" name="bukti_trf">
																		</div>
																	</div>
																</fieldset>


															</div>

															<div class="modal-footer">

																<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary"> Confirm</a>

																</div>

															</form>

														</div>
													</div>
												</div>

												<div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
															</div>


															<div class="modal-body">
																<!-- <h6 class="text-semibold">Text in a modal</h6> -->

																<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
																<br>
															</div>

															<div class="modal-footer">

																<?php 
																$saldo = $row->totalharga + $row->totalongkir;
																$saldobuyer = substr($saldo, -3);
																$saldo = substr($saldo, 0, -3) . '000';
																?>

																<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop.'/'.$saldo.'/'.$saldobuyer);?>"> Confirm</a>

															</div>

														</div>
													</div>
												</div>

											</tr>

										<?php endif; ?>

									<?php else: ?>

										<tr>
											<td><?= $counter ?></td>
											<td><a href="<?= base_url('order/details/'.$row->id_transaction) ?>"><?= $row->id_transaction ?> (Click for order details)</a></td>
											<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
											<td><?= $history_product->qty ?></td>
											<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
											<td><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
											<td><?= $history_seller->status ?></td>
											<td><a href="http://cekresi.com/?noresi=<?= $history_seller->resi ?>" target="_blank"><?= $history_seller->resi ?></a></td>
											<?php if($history_seller->status == "Pending" || $history_seller->status == "On Delivery"):?>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>

															<ul class="dropdown-menu dropdown-menu-right">

																<?php if($history_seller->status == "Pending"):?>
																	<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Konfirmasi Transfer</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Konfirmasi Transfer</a></li>
																<?php endif; ?>

																<?php if($history_seller->status == "On Delivery"):?>
																	<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Barang Diterima</a></li>
																<?php endif; ?>

															</ul>
														</li>
													</ul>
												</td>
											<?php else: ?>
												<td class="text-center">

												</td>
											<?php endif; ?>

											<!-- Basic modal -->
											<div id="modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h5 class="modal-title">Konfirmasi Transfer</h5>
														</div>

														<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$session["id_user"].'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>" enctype='multipart/form-data'>

															<div class="modal-body">
																<p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p>
																<br>
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
																			<input type="file" class="file-styled" name="bukti_trf">
																		</div>
																	</div>
																</fieldset>


															</div>

															<div class="modal-footer">

																<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary"> Confirm</a>

																</div>

															</form>

														</div>
													</div>
												</div>

												<div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
															</div>


															<div class="modal-body">
																<!-- <h6 class="text-semibold">Text in a modal</h6> -->

																<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
																<br>
															</div>

															<div class="modal-footer">

																<?php 
																$saldo = $row->totalharga + $row->totalongkir;
																$saldobuyer = substr($saldo, -3);
																$saldo = substr($saldo, 0, -3) . '000';
																?>

																<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop.'/'.$saldo.'/'.$saldobuyer);?>"> Confirm</a>

															</div>

														</div>
													</div>
												</div>

											</tr>

										<?php endif; ?>


									<?php else: ?>

										<?php $first = true; $firsttt = true;?>

										<?php foreach($prods as $p): ?>

											<?php 
								// $shop_detail = $this->m_shop->selectidshop($s)->row();
								// $seller_detail = $this->m_users->select($shop_detail->id_user)->row();
											$prod_detail = $this->m_products->getproduct($p)->row();
											$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();
											$history_seller = $this->m_transaction_history_seller->select2('transaction','shop',$row->id_transaction,$prod_detail->id_shop)->row();

											if($id_transbefore != $row->id_transaction){
												$firstt=true;
											} 
											?>


											<?php if($first && $id_transbefore != $row->id_transaction): ?>

												<tr>
													<td><?= $counter ?></td>
													<td rowspan="<?= count($prods) ?>"><a href="<?= base_url('order/details/'.$row->id_transaction) ?>"><?= $row->id_transaction ?> (Click for order details)</a></td>
													<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
													<td><?= $history_product->qty ?></td>
													<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
													<td rowspan="<?= count($prods) ?>"><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
													<td rowspan="<?= count($prods) ?>"><?= $history_seller->status ?></td>
													<td rowspan="<?= count($prods) ?>"><a href="http://cekresi.com/?noresi=<?= $history_seller->resi ?>" target="_blank"><?= $history_seller->resi ?></a></td>
													<?php if($history_seller->status == "Pending" || $history_seller->status == "On Delivery"):?>
														<td rowspan="<?= count($prods) ?>" class="text-center">
															<ul class="icons-list">
																<li class="dropdown">
																	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																		<i class="icon-menu9"></i>
																	</a>

																	<ul class="dropdown-menu dropdown-menu-right">

																		<?php if($history_seller->status == "Pending"):?>
																			<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Konfirmasi Transfer</a></li>
																		<?php else: ?>
																			<li class="disabled"><a> Konfirmasi Transfer</a></li>
																		<?php endif; ?>

																		<?php if($history_seller->status == "On Delivery"):?>
																			<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
																		<?php else: ?>
																			<li class="disabled"><a> Barang Diterima</a></li>
																		<?php endif; ?>

																	</ul>
																</li>
															</ul>
														</td>
													<?php else: ?>
														<td rowspan="<?= count($prods) ?>" class="text-center">

														</td>
													<?php endif; ?>

													<!-- Basic modal -->
													<div id="modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Konfirmasi Transfer</h5>
																</div>

																<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$session["id_user"].'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>" enctype='multipart/form-data'>

																	<div class="modal-body">
																		<p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p>
																		<br>
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
																					<input type="file" class="file-styled" name="bukti_trf">
																				</div>
																			</div>
																		</fieldset>


																	</div>

																	<div class="modal-footer">

																		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary"> Confirm</a>

																		</div>

																	</form>

																</div>
															</div>
														</div>

														<div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
																	</div>


																	<div class="modal-body">
																		<!-- <h6 class="text-semibold">Text in a modal</h6> -->

																		<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
																		<br>
																	</div>

																	<div class="modal-footer">

																		<?php 
																		$saldo = $row->totalharga + $row->totalongkir;
																		$saldobuyer = substr($saldo, -3);
																		$saldo = substr($saldo, 0, -3) . '000';
																		?>

																		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																		<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop.'/'.$saldo.'/'.$saldobuyer);?>"> Confirm</a>

																	</div>

																</div>
															</div>
														</div>

													</tr>

													<?php $first = false; ?>

												<?php else: ?>

													<?php if($id_transbefore == $row->id_transaction && $firsttt): ?>

														<tr>
															<td><?= $counter ?></td>
															<td style="display: none;"></td>
															<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
															<td><?= $history_product->qty ?></td>
															<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
															<td rowspan="<?= count($prods) ?>"><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
															<td rowspan="<?= count($prods) ?>"><?= $history_seller->status ?></td>
															<td rowspan="<?= count($prods) ?>"><a href="http://cekresi.com/?noresi=<?= $history_seller->resi ?>" target="_blank"><?= $history_seller->resi ?></a></td>
															<?php if($history_seller->status == "Pending" || $history_seller->status == "On Delivery"):?>
																<td rowspan="<?= count($prods) ?>" class="text-center">
																	<ul class="icons-list">
																		<li class="dropdown">
																			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-menu9"></i>
																			</a>

																			<ul class="dropdown-menu dropdown-menu-right">

																				<?php if($history_seller->status == "Pending"):?>
																					<li><a data-toggle="modal" data-target="#modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Konfirmasi Transfer</a></li>
																				<?php else: ?>
																					<li class="disabled"><a> Konfirmasi Transfer</a></li>
																				<?php endif; ?>

																				<?php if($history_seller->status == "On Delivery"):?>
																					<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
																				<?php else: ?>
																					<li class="disabled"><a> Barang Diterima</a></li>
																				<?php endif; ?>

																			</ul>
																		</li>
																	</ul>
																</td>
															<?php else: ?>
																<td rowspan="<?= count($prods) ?>" class="text-center">

																</td>
															<?php endif; ?>

															<!-- Basic modal -->
															<div id="modal_konftrf_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h5 class="modal-title">Konfirmasi Transfer</h5>
																		</div>

																		<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/konfirmasitrf/'.$row->id_transaction.'/'.$session["id_user"].'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>" enctype='multipart/form-data'>

																			<div class="modal-body">
																				<p>Konfirmasi bahwa anda telah melakukan transfer dengan mengisi form berikut:</p>
																				<br>
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
																							<input type="file" class="file-styled" name="bukti_trf">
																						</div>
																					</div>
																				</fieldset>


																			</div>

																			<div class="modal-footer">

																				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary"> Confirm</a>

																				</div>

																			</form>

																		</div>
																	</div>
																</div>

																<div id="modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																				<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
																			</div>


																			<div class="modal-body">
																				<!-- <h6 class="text-semibold">Text in a modal</h6> -->

																				<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
																				<br>
																			</div>

																			<div class="modal-footer">

																				<?php 
																				$saldo = $row->totalharga + $row->totalongkir;
																				$saldobuyer = substr($saldo, -3);
																				$saldo = substr($saldo, 0, -3) . '000';
																				?>

																				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																				<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop.'/'.$saldo.'/'.$saldobuyer);?>"> Confirm</a>

																			</div>

																		</div>
																	</div>
																</div>

															</tr>

															<?php $firsttt = false; ?>


														<?php else: ?>
															<tr>
																<td><?= $counter ?></td>
																<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
																<td><?= $history_product->qty ?></td>
																<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
																<td style="display: none"></td>
																<td style="display: none"></td>
																<td style="display: none"></td>
																<td style="display: none"></td>
																<td style="display: none"></td>

															</tr>
														<?php endif; ?>



													<?php endif; ?>

													<?php $counter++; $dontcount = true; ?>

												<?php endforeach; ?>

											<?php endif; ?>

											<?php if(!$dontcount){$counter++;} $id_transbefore = $row->id_transaction; ?>

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