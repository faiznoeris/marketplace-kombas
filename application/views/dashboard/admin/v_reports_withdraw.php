<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Withdraw Request List</b></h5>
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
						<th>Seller</th>
						<th>Bank</th>
						<th>Rekening</th>
						<th>Jumlah</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th class="text-center">Aksi</th>
						<th style="display: none;"></th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1;?>

					<?php foreach ($data_withdraw as $row): ?>

						<?php 

						$shop_detail = $this->M_Index->data_productview_getshop($row->id_shop)->row();
						$id_seller = $shop_detail->id_user;
						$seller_detail = $this->M_Index->data_productview_getuser($id_seller)->row();

						?>

						<tr>
							<td><?= $counter ?></td>
							<td><?= $seller_detail->username ?></td>
							<td><?= $shop_detail->bank ?></td>
							<td><?= $shop_detail->rekening ?></td>
							<td>Rp. <?= number_format($row->amount, 0, ',', '.') ?></td>
							<td><?= $row->date ?></td>
							<td><?= $row->status ?></td>
							<?php if($row->status == "Pending"):?>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">

												<li><a data-toggle="modal" data-target="#modal_approvewithdraw_<?= $row->id_withdraw ?>") ?> Transfer Received</a></li>

											</ul>
										</li>
									</ul>
								</td>
							<?php else: ?>

								<td></td>	

							<?php endif; ?>
							<td style="display: none;"></td>

							<!-- Basic modal -->
							<div id="modal_approvewithdraw_<?= $row->id_withdraw ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Approve Withdraw</h5>
										</div>


										<div class="modal-body">
											<br>
											<p>Approve withdraw untuk seller <i><?= $seller_detail->username ?></i>?<br><b>This can't be undone.</b></p>
											<br>
										</div>

										<div class="modal-footer">

											<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
											<a class="btn btn-primary" href="<?php echo base_url('Admins/accwithdraw/'.$row->id_withdraw);?>"> Confirm</a>

										</div>

									</div>
								</div>
							</div>

						</tr>

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