<div id="jGrowl-excryreports-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Delivery Order Exceed Deadline</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li>Reports</li>
				<li class="active">Delivery Exceed Deadline</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">




		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Delivery Exceed Deadline</b></h5>
				<span>*Delivery Exceed Deadline adalah untuk memberikan peringatan kepada seller yang belum mengirimkan barang setelah deadline untuk pengiriman barang.</span>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>#</th>
						<th>Id Transaksi</th>
						<th>Nama Barang</th>
						<th>Total Buyer Transfer</th>
						<th>Date Ordered</th>
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

						$datetime1 = new DateTime($row->date_ordered);
						$datetime2 = new DateTime($datenow);

						$interval = $datetime1->diff($datetime2);

						$daydistance = $interval->format('%a');
						?>

						<?php if($daydistance > 5 && $row->status != "Delivered" && $row->status != "On Delivery"): ?>

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
									<td><?= $row->date_ordered ?></td>
									<td><?= $row->status ?></td>
									<?php if($row->warning == "0"):?>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">

														<?php if($row->warning == "0"):?>
															<li><a data-toggle="modal" data-target="#modal_warnseller_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Warn Seller</a></li>
														<?php else: ?>
															<li class="disabled"><a> Warn Seller</a></li>
														<?php endif; ?>

													</ul>
												</li>
											</ul>
										</td>
									<?php else: ?>
										<td></td>
									<?php endif; ?>

									<!-- Basic modal -->
									<div id="modal_warnseller_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Warn Seller</h5>
												</div>


												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->

													<p>Peringkatkan seller untuk mengirim barang karena sudah melewati batas deadline?</p>
													<br>
												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<a class="btn btn-primary" href="<?php echo base_url('Admins/warnseller/'.$row->id_transaction.'/'.$prod_detail->id_shop);?>"> Confirm</a>

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
											<td rowspan="<?= count($prods) ?>"><?= $row->date_ordered ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->status ?></td>
											<?php if($row->warning == "0"):?>
												<td rowspan="<?= count($prods) ?>" class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>

															<ul class="dropdown-menu dropdown-menu-right">

																<?php if($row->warning == "0"):?>
																	<li><a data-toggle="modal" data-target="#modal_warnseller_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>") ?> Warn Seller</a></li>
																<?php else: ?>
																	<li class="disabled"><a> Warn Seller</a></li>
																<?php endif; ?>

															</ul>
														</li>
													</ul>
												</td>
											<?php else: ?>
												<td></td>
											<?php endif; ?>

											<!-- Basic modal -->
											<div id="modal_warnseller_<?= $row->id_transaction ?>_<?= $prod_detail->id_shop ?>" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h5 class="modal-title">Warn Seller</h5>
														</div>


														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<p>Peringkatkan seller untuk mengirim barang karena sudah melewati batas deadline?</p>
															<br>
														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<a class="btn btn-primary" href="<?php echo base_url('Admins/warnseller/'.$row->id_transaction.'/'.$prod_detail->id_shop);?>"> Confirm</a>

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