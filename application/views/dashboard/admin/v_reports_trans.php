<div id="jGrowl-trareports-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Trsansaction Reports</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li>Reports</li>
				<li class="active">Transaction</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Daftar Transaksi</b></h5>
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
						<th>Seller</th>
						<th>Buyer</th>
						<th>Barang</th>
						<th>Harga</th>
						<th>Status</th>
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
							$history = $this->m_transaction_history->select('orderdetails',$row->id_transaction)->row();

							$id_user = $this->m_shop->selectidshop($prod_detail->id_shop)->row()->id_user;
							$seller_detail = $this->m_users->select($id_user)->row();
							$buyer_detail = $this->m_users->select($history->id_user)->row();

							?>

							<?php if($jmlproduk > 1): ?>

								<?php if($id_transbefore != $row->id_transaction){$firstt=true;} ?>

								<?php if($firstt): ?>

									<tr>
										<td><?= $counter ?></td>
										<td rowspan="<?= count($totprods) ?>"><?= $row->id_transaction ?></td>
										<!-- <td><?= $row->id_transaction ?></td> -->
										<td><?= $seller_detail->username ?></td>
										<td rowspan="<?= count($totprods) ?>"><?= $buyer_detail->username ?></td>
										<td><?= $prod_detail->nama_product ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td rowspan="<?= count($totprods) ?>"><?= $history_seller->status ?></td>
										<?php if($history_seller->status == "Transfer Confirmed By User"):?>
											<td rowspan="<?= count($totprods) ?>" class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

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
											<td rowspan="<?= count($totprods) ?>"></td>
										<?php endif; ?>


										<!-- Basic modal -->
										<div id="modal_acctrf_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Approve Transfer From User</h5>
													</div>


													<div class="modal-body">
														<!-- <h6 class="text-semibold">Text in a modal</h6> -->
														<fieldset>
															<?php 
															$data_konf = $this->m_confirmation->selectforadmin($row->id_transaction,$buyer_detail->id_user)->row();
															?>
															Buyer: <i><b><?= $buyer_detail->username ?></b></i><br>
															Atas Nama: <i><b><?= $data_konf->atasnama ?></b></i><br>
															No. Rekening: <i><b><?= $data_konf->no_rekening ?></b></i><br>
															From Bank: <i><b><?= $data_konf->from_bank ?></b></i><br>
															To Bank: <i><b></b></i><br>
															Nominal: <i><b>Rp. <?= number_format($row->totalharga + $row->totalongkir, 0, ',', '.') ?></b></i><br>
															Bukti Transfer: <br><img src='<?= base_url($data_konf->bukti_path) ?>' height="550" width="550"/> 

														</fieldset>
														<br>
														<p>Konfirmasi bahwa transfer dari buyer telah diterima untuk invoice <i><?= $row->id_transaction ?></i> dan dapat diteruskan untuk proses pengiriman oleh seller? <br><b>This can't be undone.</b></p>
														<br>
													</div>

													<div class="modal-footer">

														<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
														<a class="btn btn-primary" href="<?php echo base_url('Admins/acctrf/'.$row->id_transaction.'/'.$buyer_detail->id_user.'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>"> Confirm</a>

													</div>

												</div>
											</div>
										</div>

									</tr>

									<?php $firstt = false; ?>

								<?php else: ?>

									<tr>
										<td><?= $counter ?></td>
										<!-- <td><?= $row->id_transaction ?></td> -->
										<td><?= $seller_detail->username ?></td>
										<td style="display: none"></td>
										<td><?= $prod_detail->nama_product ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td style="display: none"></td>
										<td style="display: none"></td>
										<td style="display: none"></td>
									</tr>

								<?php endif; ?>

							<?php else: ?>

								<tr>
									<td><?= $counter ?></td>
									<td><?= $row->id_transaction ?></td>
									<td><?= $seller_detail->username ?></td>
									<td><?= $buyer_detail->username ?></td>
									<td><?= $prod_detail->nama_product ?></td>
									<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
									<td><?= $history_seller->status ?></td>
									<?php if($history_seller->status == "Transfer Confirmed By User"):?>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

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
										<td rowspan="<?= count($totprods) ?>"></td>
									<?php endif; ?>

									<!-- Basic modal -->
									<div id="modal_acctrf_<?= $row->id_transaction ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Approve Transfer From User</h5>
												</div>


												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->
													<fieldset>
														<?php 
														$data_konf = $this->m_confirmation->selectforadmin($row->id_transaction,$buyer_detail->id_user)->row();
														$bank = $this->m_banks->get($data_konf->id_bank)->row()->nama_bank;
														?>
														Buyer: <i><b><?= $buyer_detail->username ?></b></i><br>
														Atas Nama: <i><b><?= $data_konf->atasnama ?></b></i><br>
														No. Rekening: <i><b><?= $data_konf->no_rekening ?></b></i><br>
														From Bank: <i><b><?= $data_konf->from_bank ?></b></i><br>
														To Bank: <i><b><?= $bank ?></b></i><br>
														Nominal: <i><b>Rp. <?= number_format($row->totalharga + $row->totalongkir, 0, ',', '.') ?></b></i><br>
														Bukti Transfer: <img src='<?= base_url($data_konf->bukti_path) ?>'  height="550" width="550"/> 

													</fieldset>
													<br>
													<p>Konfirmasi bahwa transfer dari buyer telah diterima untuk invoice <i><?= $row->id_transaction ?></i> dan dapat diteruskan untuk proses pengiriman oleh seller? <br><b>This can't be undone.</b></p>
													<br>
												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<a class="btn btn-primary" href="<?php echo base_url('Admins/acctrf/'.$row->id_transaction.'/'.$buyer_detail->id_user.'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>"> Confirm</a>

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
								$history = $this->m_transaction_history->select('orderdetails',$row->id_transaction)->row();

								$id_user = $this->m_shop->selectidshop($prod_detail->id_shop)->row()->id_user;
								$seller_detail = $this->m_users->select($id_user)->row();
								$buyer_detail = $this->m_users->select($history->id_user)->row();

								if($id_transbefore != $row->id_transaction){
									$firstt=true;
								} 
								?>


								<?php if($first && $id_transbefore != $row->id_transaction): ?>

									<tr>
										<td><?= $counter ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $row->id_transaction ?></td>
										<!-- <td><?= $row->id_transaction ?></td> -->
										<td><?= $seller_detail->username ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $buyer_detail->username ?></td>
										<td><?= $prod_detail->nama_product ?></td>
										<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $history_seller->status ?></td>
										<?php if($history_seller->status == "Transfer Confirmed By User"):?>
											<td rowspan="<?= count($prods) ?>" class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

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
											<td rowspan="<?= count($totprods) ?>"></td>
										<?php endif; ?>

										<!-- Basic modal -->
										<div id="modal_acctrf_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Approve Transfer From User</h5>
													</div>


													<div class="modal-body">
														<!-- <h6 class="text-semibold">Text in a modal</h6> -->
														<fieldset>
															<?php 
															$data_konf = $this->m_confirmation->selectforadmin($row->id_transaction,$buyer_detail->id_user)->row();
															?>
															Buyer: <i><b><?= $buyer_detail->username ?></b></i><br>
															Atas Nama: <i><b><?= $data_konf->atasnama ?></b></i><br>
															No. Rekening: <i><b><?= $data_konf->no_rekening ?></b></i><br>
															From Bank: <i><b><?= $data_konf->from_bank ?></b></i><br>
															To Bank: <i><b></b></i><br>
															Nominal: <i><b>Rp. <?= number_format($row->totalharga + $row->totalongkir, 0, ',', '.') ?></b></i><br>
															Bukti Transfer: <img src='<?= base_url($data_konf->bukti_path) ?>'/> <img src='<?= base_url($row->bukti_path) ?>'  height="550" width="550"/>

														</fieldset>
														<br>
														<p>Konfirmasi bahwa transfer dari buyer telah diterima untuk invoice <i><?= $row->id_transaction ?></i> dan dapat diteruskan untuk proses pengiriman oleh seller? <br><b>This can't be undone.</b></p>
														<br>
													</div>

													<div class="modal-footer">

														<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
														<a class="btn btn-primary" href="<?php echo base_url('Admins/acctrf/'.$row->id_transaction.'/'.$buyer_detail->id_user.'/'.$prod_detail->id_shop.'/'.$jmlproduk);?>"> Confirm</a>

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
											<!-- <td><?= $row->id_transaction ?></td> -->
											<td style="display: none;"></td>
											<td><?= $seller_detail->username ?></td>
											<td style="display: none"></td>
											<td><?= $prod_detail->nama_product ?></td>
											<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
											<td style="display: none"></td>
											<td style="display: none"></td>
											<td style="display: none"></td>

										</tr>

										<?php $firsttt = false; ?>


									<?php else: ?>
										<tr>
											<td><?= $counter ?></td>
											<!-- <td><?= $row->id_transaction ?></td> -->
											<td><?= $seller_detail->username ?></td>
											<td style="display: none"></td>
											<td><?= $prod_detail->nama_product ?></td>
											<td>Rp. <?= number_format($history_product->harga, 0, ',', '.') ?></td>
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