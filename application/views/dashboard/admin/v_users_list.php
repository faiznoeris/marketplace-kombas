<!-- Main content -->
<div class="content-wrapper">


<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Menambahkan User Baru</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/adduser/');?>">
					<fieldset class="content-group">
						<legend class="text-bold">Data User</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Lengkap</label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Masukkan nama awal" name="first_name">
										<span class="help-block">First Name</span>
									</div>

									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Masukkan nama akhir" name="last_name">
										<span class="help-block">Last Name</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Username</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" maxlength="12" placeholder="Masukkan username" name="username">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Email</label>
							<div class="col-md-10">
								<input class="form-control" type="email" placeholder="Masukkan email" name="email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Telephone</label>
							<div class="col-md-10">
								<input class="form-control" type="tel" placeholder="Masukkan nomor telephone" name="telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Password</label>
							<div class="col-lg-10">
								<input type="password" class="form-control" placeholder="Masukkan password" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Jenis User</label>
							<div class="col-lg-10">
								<select name="user_type" class="form-control">
									<option value="3">User</option>
									<option value="4">Seller</option>
									<option value="5">Re-Seller</option>				
								</select>
							</div>
						</div>

						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="btnsubmit">Tambahhkan <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<!-- /form horizontal -->

	<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Data users yang terdaftar pada database</h5><br>
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
				<?php foreach ($users as $row) { ?>

				<?php if($row->username != $data_session["username"] && $row->tipeuser != "Super Admin" && $row->tipeuser != "Admin"): ?>
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
<!-- /main content -->