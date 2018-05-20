<!-- Content area -->
<div class="content">		 

	<!-- Registration form -->
	<form method="post" action="<?php echo base_url('Auth/register/');?>" id="needs-validation" novalidate>
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<div class="panel registration-form">
					<div class="panel-body">
						<div class="text-center">
							<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
							<h5 class="content-group-lg">Create account <small class="display-block">All fields are required</small></h5>
						</div>

						<div class="form-group has-feedback">
							<input type="text" class="form-control" placeholder="Choose username" name="username" required>
							<div class="form-control-feedback">
								<i class="icon-user-plus text-muted"></i>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control" placeholder="First name" name="first_name" required>
									<div class="form-control-feedback">
										<i class="icon-user-check text-muted"></i>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control" placeholder="Second name" name="last_name" required>
									<div class="form-control-feedback">
										<i class="icon-user-check text-muted"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="password" class="form-control" placeholder="Create password" name="password" required>
									<div class="form-control-feedback">
										<i class="icon-user-lock text-muted"></i>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="password" class="form-control" placeholder="Repeat password" name="confirm_password" required>
									<div class="form-control-feedback">
										<i class="icon-user-lock text-muted"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="email" class="form-control" placeholder="Your email" name="email" required>
									<div class="form-control-feedback">
										<i class="icon-mention text-muted"></i>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control" placeholder="Your Phone Number" name="telephone" required>
									<div class="form-control-feedback">
										<i class="icon-phone2 text-muted"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<?=$image;?> 
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Tulis angka yang ada disamping" name="security_code">
								</div>
							</div>
						</div>

<!-- 						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled" checked="checked">
									Send me <a href="#">test account settings</a>
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled" checked="checked">
									Subscribe to monthly newsletter
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled">
									Accept <a href="#">terms of service</a>
								</label>
							</div>
						</div> -->

						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<a href="<?= base_url('login') ?>" class="btn btn-link"><i class="icon-arrow-left13 position-left"></i> Back to login form</a>
							<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create account</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!-- /registration form -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
