<!-- Main content -->
<div class="content-wrapper">


		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Edit User</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/edituser/'.$user->id_user);?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data User</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Lengkap</label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" value="<?= $user->first_name ?>" name="first_name">
										<span class="help-block">First Name</span>
									</div>

									<div class="col-md-6">
										<input type="text" class="form-control" value="<?= $user->last_name ?>" name="last_name">
										<span class="help-block">Last Name</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Username</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" maxlength="12" value="<?= $user->username ?>" name="username">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Email</label>
							<div class="col-md-10">
								<input class="form-control" type="email" value="<?= $user->email ?>" name="email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Telephone</label>
							<div class="col-md-10">
								<input class="form-control" type="tel" value="<?= $user->telephone ?>" name="telephone">
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
									<?php if($user->id_userlevel == '3'): ?>
										<option value="3" selected>User</option>
									<?php else: ?>
										<option value="3">User</option>
									<?php endif; ?>

									<?php if($user->id_userlevel == '4'): ?>
										<option value="4" selected>Seller</option>
									<?php else: ?>
										<option value="4">Seller</option>
									<?php endif; ?>

									<?php if($user->id_userlevel == '5'): ?>
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
							<a href="<?= base_url('dashboard/users') ?>" class="btn btn-link">Batal</a>
							<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<!-- /form horizontal -->



</div>
<!-- /main content -->


