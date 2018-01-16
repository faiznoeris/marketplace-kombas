<div id="jGrowl-category-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Daftar Category</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Daftar Category</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data category yang terdaftar pada database</h5><br>
				<a class="btn bg-grey btn-xs" href="<?= base_url('dashboard/category/add') ?>" style="margin-left:-5px;">Add New Category</i></a>
			</div>



			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Id Category</th>
						<th>Nama Category</th>
						<th style="display: none;"></th>
						<th class="text-center">Actions</th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
					</tr>
				</thead>
				<tbody>
					<?php $count = 1; ?>
					<?php foreach ($data_cat as $row) { ?>

					<tr>
						
						<td><?= $count ?></td>
						<td><?= $row->nama_category ?></td>
						<td style="display: none;"></td>

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?= base_url('dashboard/category/edit/'.$row->id_category) ?>"><i class="icon-pencil5"></i> Edit</a></li>

										<li><a data-toggle="modal" data-target="#modal_delete_cat_<?= $row->id_category ?>"><i class="icon-trash-alt"></i> Delete</a></li>
									</ul>
								</li>
							</ul>
						</td>

						<td style="display: none;"></td>
						<td style="display: none;"></td>
						<?php $count++ ?>

						<!-- Basic modal -->
						<div id="modal_delete_cat_<?= $row->id_category ?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Hapus Category</h5>
									</div>

									<div class="modal-body">
										<!-- <h6 class="text-semibold">Text in a modal</h6> -->
										<p>Hapus category <i><?= $row->nama_category ?></i>? <br><b>Anda tidak bisa meng-undo setelah menghapus category tersebut!</b></p>

									</div>

									<div class="modal-footer">
										
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<a href="<?= base_url('Admins/deletecategory/'.$row->id_category) ?>" class="btn btn-primary">Confirm</a>

									</div>
								</div>
							</div>
						</div>
						<!-- /basic modal -->

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

