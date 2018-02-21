<div id="jGrowl-excredreports-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Delivered Order Exceed Deadline</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li>Reports</li>
				<li class="active">Delivered Exceed Deadline</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">




		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Delivered Exceed Deadline</b></h5>
				<span>*Delivered Exceed Deadline adalah untuk melakukan konfirmasi barang diterima secara manual oleh admin dengan mengecek resi yang ada terlebih dahulu apakah barang sudah diterima oleh pembeli atau belum.</span>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>#</th>
						<th>Id Transaksi</th>
						<th>Nama Barang</th>
						<th>Total Buyer Transfer</th>
						<th>Date Delivered</th>
						<th>Resi</th>
						<th>Status</th>
						<th class="text-center">Aksi</th>

					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					<?php foreach ($data_exceed as $row): ?>

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
									<td>Rp. <?= number_format($row->totalharga, 0, ',', '.') ?></td>
									<td><?= $row->date_delivered ?></td>
									<td><a href="http://cekresi.com/?noresi=<?= $row->resi ?>" target="_blank"><?= $row->resi ?></a></td>
									<td><?= $row->status ?></td>
									<?php if($row->status == "On Delivery"):?>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">

														<?php if($row->status == "On Delivery"):?>
															<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
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

									<!-- Basic modal -->
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
													<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$row->id_shop.'/'.$saldo.'/'.$saldobuyer.'/admin/'.$row->id_user);?>"> Confirm</a>

												</div>

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
											<td rowspan="<?= count($prods) ?>">Rp. <?= number_format($row->totalharga, 0, ',', '.') ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->date_delivered ?></td>
											<td rowspan="<?= count($prods) ?>"><a href="http://cekresi.com/?noresi=<?= $row->resi ?>" target="_blank"><?= $row->resi ?></a></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->status ?></td>
											<?php if($row->status == "On Delivery"):?>
												<td rowspan="<?= count($prods) ?>" class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>

															<ul class="dropdown-menu dropdown-menu-right">

																<?php if($row->status == "On Delivery"):?>
																	<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Barang Diterima</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Barang Diterima</a></li>
																<?php endif; ?>

															</ul>
														</li>
													</ul>
												</td>
											<?php else: ?>
												<td rowspan="<?= count($prods) ?>"></td>
											<?php endif; ?>

											<!-- Basic modal -->
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
															<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$row->id_shop.'/'.$saldo.'/'.$saldobuyer.'/admin/'.$row->id_user);?>"> Confirm</a>

														</div>

													</div>
												</div>
											</div>

										</tr>

										<?php $first = false; ?>

									<?php else: ?>

										<tr>
											<td><?= $counter ?></td>
											<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
											<td style="display: none;"></td>
											<td style="display: none;"></td>
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

						<?php endif; ?>

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