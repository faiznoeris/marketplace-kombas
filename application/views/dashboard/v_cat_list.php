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
				<a class="btn btn-default btn-xs" href="<?= base_url('dashboard/addcategory') ?>" style="margin-left:-5px;">Add New Category</i></a>
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
					<?php foreach ($data_cat as $row) { ?>

					<tr>
						<td><?= $row->id_category ?></td>
						<td><?= $row->nama_category ?></td>
						<td style="display: none;"></td>

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?= base_url('Index/editproduct/'.$row->id_category) ?>"><i class="icon-pencil5"></i> Edit</a></li>
										<li><a href="<?= base_url('Admins/deletecategory/'.$row->id_category) ?>"><i class="icon-trash-alt"></i> Delete</a></li>
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