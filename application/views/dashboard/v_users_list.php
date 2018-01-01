<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Daftar User</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Daftar User</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data Users Terdaftar</h5>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Email</th>
						<th>Date Join</th>
						<th>User Type</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_user as $row) { ?>

					<tr>
						<td><?= $row->username ?></td>
						<td><?= $row->first_name ?> <?= $row->last_name ?></td>
						<td><?= $row->email ?></td>
						<td><?= $row->date_joined ?></td>
						<td><?= $row->tipeuser ?></td>

						

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?= base_url('Admins/edituser/'.$row->id_user) ?>"><i class="icon-pencil5"></i> Edit</a></li>
										<li><a href="<?= base_url('Admins/deleteuser/'.$row->id_user) ?>"><i class="icon-trash-alt"></i> Delete</a></li>
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