<div id="jGrowl-users-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Users List</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Users List</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data users yang terdaftar pada database</h5><br>
				<a class="btn bg-grey btn-xs" href="<?= base_url('dashboard/users/add') ?>" style="margin-left:-5px;">Add New User</i></a>
			</div>

			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>ID User</th>
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

					<?php if($row->username != $session["username"] && $row->tipeuser != "Super Admin"): ?>
						<tr>
							<td><?= $row->id_user ?></td>
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
											<li><a href="<?= base_url('dashboard/users/edit/'.$row->id_user) ?>"><i class="icon-pencil5"></i> Edit</a></li>
											<li><a data-toggle="modal" data-target="#modal_delete_cat_<?= $row->id_user ?>"><i class="icon-trash-alt"></i> Delete</a></li>
										</ul>
									</li>
								</ul>
							</td>

							<!-- Basic modal -->
							<div id="modal_delete_cat_<?= $row->id_user ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Hapus User</h5>
										</div>

										<div class="modal-body">
											<!-- <h6 class="text-semibold">Text in a modal</h6> -->
											<p>Hapus user <i><?= $row->username ?></i>? <br><b>Anda tidak bisa meng-undo setelah menghapus user tersebut!</b></p>

										</div>

										<div class="modal-footer">

											<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
											<a href="<?= base_url('Admins/deleteuser/'.$row->id_user) ?>" class="btn btn-primary">Confirm</a>

										</div>
									</div>
								</div>
							</div>
							<!-- /basic modal -->

						</tr>
					<?php endif; ?>
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