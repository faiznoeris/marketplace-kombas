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
	<?php $this->load->view($jstheme); ?>
	<?php if(isset($jstheme2)) $this->load->view($jstheme2) ?>
	<?php if(isset($jstheme3)) $this->load->view($jstheme3) ?>
	<!-- /theme JS files -->

</head>

<body>

	<?php $this->load->view("v_navbar_dash"); ?>


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">


			<?php $this->load->view("v_sidebar_dash"); ?>
			<?php $this->load->view($content); ?>


		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
