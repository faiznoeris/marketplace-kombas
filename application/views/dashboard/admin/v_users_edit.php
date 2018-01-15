<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit User</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active"><a href="<?= base_url('dashboard/users') ?>">Users List</a></li>
				<li class="active">Edit User</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Edit User</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/edituser/'.$data_user->id_user);?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data User</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Lengkap</label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" value="<?= $data_user->first_name ?>" name="first_name">
										<span class="help-block">First Name</span>
									</div>

									<div class="col-md-6">
										<input type="text" class="form-control" value="<?= $data_user->last_name ?>" name="last_name">
										<span class="help-block">Last Name</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Username</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" maxlength="12" value="<?= $data_user->username ?>" name="username">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Email</label>
							<div class="col-md-10">
								<input class="form-control" type="email" value="<?= $data_user->email ?>" name="email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Telephone</label>
							<div class="col-md-10">
								<input class="form-control" type="tel" value="<?= $data_user->telephone ?>" name="telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Password</label>
							<div class="col-lg-10">
								<input type="password" class="form-control" placeholder="*******" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Jenis User</label>
							<div class="col-lg-10">
								<select name="user_type" class="form-control">
									<?php if($data_user->id_userlevel == '3'): ?>
										<option value="3" selected>User</option>
									<?php else: ?>
										<option value="3">User</option>
									<?php endif; ?>

									<?php if($data_user->id_userlevel == '4'): ?>
										<option value="4" selected>Seller</option>
									<?php else: ?>
										<option value="4">Seller</option>
									<?php endif; ?>

									<?php if($data_user->id_userlevel == '5'): ?>
										<option value="5" selected>Re-Seller</option>
									<?php else: ?>
										<option value="5">Re-Seller</option>
									<?php endif; ?>

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
							<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<!-- /form horizontal -->


		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->


