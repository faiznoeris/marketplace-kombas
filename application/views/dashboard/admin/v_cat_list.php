<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">

		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Tambah Category</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">
				Anda dapat menambah data cateogry produk yang tersedia dengan mengisi form berikut ini.
				<br><br>
				<form class="form-horizontal" action="<?= base_url('Admins/addcategory') ?>" method="post">
					<!-- <fieldset class="content-group">
						<legend class="text-bold">Basic inputs</legend> -->

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Category</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" name="nama_category">
							</div>
						</div>

						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="form-group">
							<label class="control-label col-lg-2"></label>
							<div class="col-lg-3">
								<button type="submit" class="btn btn-primary pull-right">Tambah</button>
							</div>
						</div>
						<!-- </fieldset> -->
					</form>
				</div>



			</div>
			<!-- /basic datatable -->

			<!-- Basic datatable -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Categories</h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="reload"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
					Pada tabel dibawah terdapat data category produk yang terdaftar pada database untuk memilah-milah produk produk yang ada pada sistem. Anda dapat mengubah ataupun menghapus category tersebut pada tabel dibawah.
				</div>


				<table class="table datatable-basic">
					<thead>
						<tr>
							<th width="30">No.</th>
							<th>Nama Category</th>
							<th class="text-center"><i class="icon-arrow-down12"></i></th>
							<th style="display: none;"></th>
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

						</tr>

						<?php } ?>

					</tbody>
				</table>

				<?php foreach($data_cat as $row): ?>
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
				<?php endforeach; ?>

			</div>
			<!-- /basic datatable -->


		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->


