<!-- Content area -->
<div class="content">		 
	<div class="panel panel-body login-form center-login col-lg-3">
		
		<div class="row" style="padding: 10px 10px 10px 10px;">

			<!-- Simple login form -->
			<form method="post" action="<?php echo base_url('Auth/login/');?>">
				<div class="text-center">
					<center><img src="<?= base_url('/assets/images/favicon.png') ?>" style="max-height: 100px; max-width: 100px;"></center>
					<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
					<div class="form-control-feedback">
						<i class="icon-user text-muted"></i>
					</div>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input type="password" class="form-control" placeholder="Password" name="password" required>
					<div class="form-control-feedback">
						<i class="icon-lock2 text-muted"></i>
					</div>
				</div>

				<label class="left">
					<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
				</label>

				<label class="left">
					<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
				</label>

				<div class="form-group">
					<button type="submit" class="btn bg-primary-400 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
				</div>

				<div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
				<a href="<?php echo base_url('register');?>" class="btn btn-default btn-block content-group">Sign up</a>
				<span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#"><strike>Cookie Policy</strike></a></span>
			</form>
			<!-- /simple login form -->
		</div>

	</div>



</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
