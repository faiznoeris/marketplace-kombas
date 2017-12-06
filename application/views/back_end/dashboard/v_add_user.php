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
	<link href="<?= base_url('/assets/dashboard-limitless/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/dashboard-limitless/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/dashboard-limitless/css/core.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/dashboard-limitless/css/components.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/dashboard-limitless/css/colors.css') ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/loaders/pace.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/core/libraries/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/core/libraries/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/loaders/blockui.min.js') ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/inputs/typeahead/handlebars.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/inputs/alpaca/alpaca.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/selects/select2.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/selects/bootstrap_multiselect.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/ui/prism.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/styling/uniform.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/core/app.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/pages/alpaca_basic.js') ?>"></script>
	<!-- /theme JS files -->


	<script src="<?= base_url('/assets/js/script.js') ?>"></script>

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?= base_url('') ?>"><img src="<?= base_url('/assets/dashboard-limitless/images/logo_light.png') ?>" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			</ul>

			<p class="navbar-text">
				<span class="label bg-success">Online</span>
			</p>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-people"></i>
							<span class="visible-xs-inline-block position-right">Users</span>
						</a>
						
						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Users online
								<ul class="icons-list">
									<li><a href="#"><i class="icon-gear"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body width-300">
								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Jordana Ansley</a>
										<span class="display-block text-muted text-size-small">Lead web developer</span>
									</div>
									<div class="media-right media-middle"><span class="status-mark border-success"></span></div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Will Brason</a>
										<span class="display-block text-muted text-size-small">Marketing manager</span>
									</div>
									<div class="media-right media-middle"><span class="status-mark border-danger"></span></div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Hanna Walden</a>
										<span class="display-block text-muted text-size-small">Project manager</span>
									</div>
									<div class="media-right media-middle"><span class="status-mark border-success"></span></div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Dori Laperriere</a>
										<span class="display-block text-muted text-size-small">Business developer</span>
									</div>
									<div class="media-right media-middle"><span class="status-mark border-warning-300"></span></div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Vanessa Aurelius</a>
										<span class="display-block text-muted text-size-small">UX expert</span>
									</div>
									<div class="media-right media-middle"><span class="status-mark border-grey-400"></span></div>
								</li>
							</ul>

							<div class="dropdown-content-footer">
								<a href="#" data-popup="tooltip" title="All users"><i class="icon-menu display-block"></i></a>
							</div>
						</div>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bubbles4"></i>
							<span class="visible-xs-inline-block position-right">Messages</span>
							<span class="badge bg-warning-400">2</span>
						</a>
						
						<div class="dropdown-menu dropdown-content width-350">
							<div class="dropdown-content-heading">
								Messages
								<ul class="icons-list">
									<li><a href="#"><i class="icon-compose"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body">
								<li class="media">
									<div class="media-left">
										<img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt="">
										<span class="badge bg-danger-400 media-badge">5</span>
									</div>

									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">James Alexander</span>
											<span class="media-annotation pull-right">04:58</span>
										</a>

										<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt="">
										<span class="badge bg-danger-400 media-badge">4</span>
									</div>

									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Margo Baker</span>
											<span class="media-annotation pull-right">12:16</span>
										</a>

										<span class="text-muted">That was something he was unable to do because...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Jeremy Victorino</span>
											<span class="media-annotation pull-right">22:48</span>
										</a>

										<span class="text-muted">But that would be extremely strained and suspicious...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Beatrix Diaz</span>
											<span class="media-annotation pull-right">Tue</span>
										</a>

										<span class="text-muted">What a strenuous career it is that I've chosen...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">Richard Vango</span>
											<span class="media-annotation pull-right">Mon</span>
										</a>
										
										<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
									</div>
								</li>
							</ul>

							<div class="dropdown-content-footer">
								<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
							</div>
						</div>
					</li>

					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" alt="">
							<span>Victoria</span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
							<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
							<li><a href="#"><span class="badge bg-blue pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
							<li class="divider"></li>
							<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
							<li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold">Victoria Baker</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Purwokerto, JATENG
									</div>
								</div>

								
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li class="active"><a href="<?= base_url('dashboard/adduser') ?>"><i class="icon-user-plus"></i> <span>Add User</span></a></li>
								<li><a href="<?= base_url('dashboard/adduser') ?>"><i class="icon-users"></i> <span>Daftar User</span></a></li>
								<li><a href="<?= base_url('dashboard/sellerpending') ?>"><i class="icon-hour-glass3"></i> <span>Seller Pending Approval</span></a></li>
								<!-- /main -->

								

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add New User</span></h4>
						</div>


					</div>

					<div class="breadcrumb-line breadcrumb-line-component">
						<ul class="breadcrumb">
							<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
							<li class="active">Add User</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

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
												<option value="opt1">Reguler User</option>
												<option value="opt2">Seller</option>
												<option value="opt3">Dropshipper</option>				
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

			</div>
			<!-- /page content -->

		</div>
		<!-- /page container -->

	</body>
	</html>
