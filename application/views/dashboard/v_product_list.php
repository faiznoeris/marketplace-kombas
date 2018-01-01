<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Approve Pending Seller</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Seller Pending Approval</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data user yang pending untuk menjadi seller</h5>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Nama Product</th>
						<th>Deskripsi Product</th>
						<th>Harga Product</th>
						<th class="text-center">Actions</th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_product as $row) { ?>

					<tr>
						<td><?= $row->nama_product ?></td>
						<td><?= $row->deskripsi_product ?></td>
						<td><?= $row->harga ?></td>

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?= base_url('Index/editproduct/'.$row->id_product) ?>"><i class="icon-pencil5"></i> Edit</a></li>
										<li><a href="<?= base_url('Admins/deleteproduct/'.$row->id_product) ?>"><i class="icon-trash-alt"></i> Delete</a></li>
									</ul>
								</li>
							</ul>
						</td>

						<td style="display: none;"></td>
						<td style="display: none;"></td>
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