<div id="jGrowl-address-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Basic modal -->
<div id="modal_req_seller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradeseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Basic modal -->
<div id="modal_req_reseller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradereseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
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
				<h5 class="panel-title">Data Alamat Anda</h5><br>
				<a class="btn btn-default btn-xs" href="<?= base_url('dashboard/alamat/add') ?>" style="margin-left:-5px;">Add New Alamat</i></a>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>#</th>
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

					<?php $counter = 1 ?>

					<tr>	
						<td><?= $counter ?></td>
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
										<li><a href="<?= base_url('dashboard/alamat/edit/'. $row->id_address) ?>"><i class="icon-pencil5"></i> Edit</a></li>
										<li><a data-toggle="modal" data-target="#modal_del_address_<?= $row->id_address ?>"><i class="icon-trash-alt"></i> Delete</a></li>
									</ul>
								</li>
							</ul>
						</td>

						<!-- Basic modal -->
						<div id="modal_del_address_<?= $row->id_address ?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Hapus Alamat</h5>
									</div>

									<div class="modal-body">
										<!-- <h6 class="text-semibold">Text in a modal</h6> -->
										<p>Apakah anda yakin untuk menghapus alamat dengan nama <i><?= $row->namaalamat ?></i> ? <br><b>Anda tidak bisa meng-undo setelah menghapus alamat tersebut!</b></p>

									</div>

									<div class="modal-footer">

										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<a href="<?= base_url('Address/delete/'. $row->id_address) ?>" class="btn btn-primary">Confirm</a>

									</div>
								</div>
							</div>
						</div>
						<!-- /basic modal -->

						<?php $counter++; ?>

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