<!-- Content area -->
<div class="content-wrapper">
	<!-- Account Settings -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Account Settings &nbsp; <i class="icon-profile"></i></h6>
		</div>

		<div class="panel-body">
			<form method="post" action="<?= base_url('Account/editaccount') ?>" enctype='multipart/form-data'>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>First Name</label>
							<input type="text" value="<?= $user_data->first_name ?>" class="form-control" name="first_name">
						</div>

						<div class="col-md-6">
							<label>Last Name</label>
							<input type="text" value="<?= $user_data->last_name ?>" class="form-control" name="last_name">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Telephone</label>
							<input type="text" value="<?= $user_data->telephone ?>" class="form-control" name="telephone">
							<span class="help-block"><?= $user_data->telephone ?></span>
						</div>

						<div class="col-md-6">
							<label>E-mail</label>
							<input type="email" value="<?= $user_data->email ?>" class="form-control" name="email">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Username</label>
							<input type="text" value="<?= $user_data->username ?>" readonly="readonly" class="form-control" name="username">
						</div>

						<div class="col-md-6">
							<label>Current password</label>
							<input type="password" value="password" readonly="readonly" class="form-control">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>New password</label>
							<input type="password" placeholder="Enter new password" class="form-control" name="new_pwd">
						</div>

						<div class="col-md-6">
							<label>Repeat password</label>
							<input type="password" placeholder="Repeat new password" class="form-control" name="new_pwd_confirm">
						</div>
					</div>
				</div>


				<div class="form-group">
					<div class="row">

						<div class="col-md-6">
							<label class="display-block">Upload profile image</label>
							<input type="file" class="file-styled" name="avatar">
							<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
						</div>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Account Settings -->

</div>
<!-- /main content -->
