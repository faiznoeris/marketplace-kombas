
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Tittle -->
	<title><?= $title ?></title>

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('/assets/images/favicon.png') ?>">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_5/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_5/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_5/css/core.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_5/css/components.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_5/css/colors.css') ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/loaders/pace.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/core/libraries/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/core/libraries/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/loaders/blockui.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/ui/nicescroll.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/ui/drilldown.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/ui/fab.min.js') ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/validation/validate.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/uniform.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/core/app.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/login_validation.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/ui/ripple.min.js') ?>"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container login-cover">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">

					<!-- Form with validation -->
					<form method="post" action="<?php echo base_url('Admins/login');?>" class="form-validate">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="username" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" required="required">
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
								<button type="submit" class="btn bg-pink-400 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>

							
						</div>
					</form>
					<!-- /form with validation -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
