<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Approve Pending Reseller</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Reseller Pending Approval</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data user yang pending untuk menjadi Reseller</h5>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Email</th>
						<th>Tanggal Request Approval</th>
						<th>Status Approval</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_resellerpending as $row) { ?>

					<tr>
						<td><?= $row->username ?></td>
						<td><?= $row->first_name ?> <?= $row->last_name ?></td>
						<td><?= $row->email ?></td>
						<td><?= $row->date2 ?></td>

						<?php if($row->status == "Pending"): ?>
							<td><span class="label label-info"><?= $row->status ?></span></td>	
						<?php else: ?>
							<td><span class="label label-success"><?= $row->status ?></span></td>
						<?php endif; ?>

						<td class="text-center">
							<?php if($row->status == "Pending"): ?>
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="<?= base_url('Admins/approvereseller/'.$row->id_user) ?>"><i class="icon-checkmark3"></i> Approve</a></li>
											<li><a href="#"><i class="icon-cross2"></i> Decline</a></li>
										</ul>
									</li>
								</ul>
							<?php else: ?>
								-
							<?php endif; ?>
						</td>
					</tr>

					<?php } ?>

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