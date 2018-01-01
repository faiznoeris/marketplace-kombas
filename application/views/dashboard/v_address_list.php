<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Daftar Alamat</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Daftar Alamat</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data Alamat Anda</h5>
				<a class="btn btn-default btn-xs" href="<?= base_url('dashboard/alamat/add') ?>" style="margin-left:-5px;">Add New Alamat</i></a>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Nama Alamat</th>
						<th>Atas Nama</th>
						<th>Alamat Lengkap</th>
						<th>Telephone</th>
						<th style="display: none;"></th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($alamat as $row) { ?>

					<tr>
						<td><?= $row->namaalamat ?></td>
						<td><?= $row->atasnama ?></td>
						<td><?= $row->alamat ?></td>
						<td><?= $row->telephone ?></td>
						<td style="display: none;"></td>

						

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?= base_url('dashboard/alamat/edit/'. $row->id_alamat) ?>"><i class="icon-pencil5"></i> Edit</a></li>
										<li><a href="<?= base_url('Address/delete/'. $row->id_alamat) ?>"><i class="icon-trash-alt"></i> Delete</a></li>
									</ul>
								</li>
							</ul>
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