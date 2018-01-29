<div id="jGrowl-witreports-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Withdraw Reports</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li>Reports</li>
				<li class="active">Withdraw</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


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

						$shop_detail = $this->m_shop->selectidshop($row->id_shop)->row();
						$id_seller = $shop_detail->id_user;
						$seller_detail = $this->m_users->select($id_seller)->row();

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
											<a class="btn btn-primary" href="<?php echo base_url('Admins/approvewithdraw/'.$row->id_withdraw);?>"> Confirm</a>

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