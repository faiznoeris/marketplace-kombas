<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Cancelled Order</b></h5>
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
						<th>Total Transfer</th>
						<th>Date Cancelled</th>
						<th>Last Status</th>
						<th class="text-center">Aksi</th>

					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					<?php foreach ($cancelled_order as $row): ?>

						<?php if($row->last_status != "Pending"): ?>

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
									<td>Rp. <?= number_format($row->total, 0, ',', '.') ?></td>
									<td><?= $row->date ?></td>
									<td><?= $row->last_status ?></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">

													<?php if($row->refund == "0"):?>
														<li><a data-toggle="modal" data-target="#modal_accref_<?= $row->id_transaction ?>") ?> Confirm Refund</a></li>
													<?php else: ?>
														<li class="disabled"><a> Confirm Refund</a></li>
													<?php endif; ?>

												</ul>
											</li>
										</ul>
									</td>

									<!-- Basic modal -->
									<div id="modal_accref_<?= $row->id_transaction ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h5 class="modal-title">Confirm Refund</h5>
												</div>


												<div class="modal-body">
													<!-- <h6 class="text-semibold">Text in a modal</h6> -->
													<p>Konfirmasi bahwa admin telah melakukan refund terhadap order yang dicancel? <br><b>This can't be undone.</b></p>
													<br>
												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
													<a class="btn btn-primary" href="<?php echo base_url('Admins/accrefund/'.$row->id_transaction);?>"> Confirm</a>

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
											<td rowspan="<?= count($prods) ?>">Rp. <?= number_format($row->total, 0, ',', '.') ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->date ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->last_status ?></td>
											<td rowspan="<?= count($prods) ?>" class="text-center">
												<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right">

															<?php if($row->refund == "0"):?>
																<li><a data-toggle="modal" data-target="#modal_accref_<?= $row->id_transaction ?>") ?> Confirm Refund</a></li>
															<?php else: ?>
																<li class="disabled"><a> Confirm Refund</a></li>
															<?php endif; ?>

														</ul>
													</li>
												</ul>
											</td>

											<!-- Basic modal -->
											<div id="modal_accref_<?= $row->id_transaction ?>" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h5 class="modal-title">Confirm Refund</h5>
														</div>


														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->
															<p>Konfirmasi bahwa admin telah melakukan refund terhadap order yang dicancel? <br><b>This can't be undone.</b></p>
															<br>
														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<a class="btn btn-primary" href="<?php echo base_url('Admins/accref/'.$row->id_transaction);?>"> Confirm</a>

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