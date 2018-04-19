<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Tittle -->
	<title><?= $title ?></title>

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('/assets/images/favicon.png') ?>">

	<!-- Template.css -->
	<link href="<?= base_url('/assets/css/template.css') ?>" rel="stylesheet" type="text/css">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_1/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_1/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_1/css/core.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_1/css/components.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/limitless_1/css/colors.css') ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/loaders/pace.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/libraries/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/libraries/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/loaders/blockui.min.js') ?>"></script>
	<!-- /core JS files -->

	<!-- Slick Slider -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/js/slick/slick.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/js/slick/slick-theme.css') ?>"/>

	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url('/assets/js/slick/slick.min.js') ?>"></script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/velocity/velocity.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/velocity/velocity.ui.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/prism.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/app.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/animations_velocity_examples.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/ripple.min.js') ?>"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/media/fancybox.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/ecommerce_product_list.js') ?>"></script>
	<!-- /theme JS files -->

	<?php if($active == "shop"): ?>
		<!-- Theme JS files -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/ckeditor/ckeditor.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/blog_single.js') ?>"></script>
		<!-- /theme JS files -->
	<?php endif; ?>

	<?php if($active == "account"): ?>
		<!-- Theme JS files -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/buttons.min.js') ?>"></script>


		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/selects/select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/moment/moment.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/fullcalendar/fullcalendar.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/echarts/echarts.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/user_pages_profile.js') ?>"></script>


		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/ecommerce_orders_history.js') ?>"></script>

		<!-- /theme JS files -->
	<?php endif; ?>

</head>
<body class="has-detached-right">

	<!-- NAVBAR CONTENT -->
	<?php $this->load->view("v_navbar"); ?>
	<!-- NAVBAR END -->

	<!-- PAGE CONTENT -->
	<?php $this->load->view($content); ?>
	<!-- PAGE CONTENT END -->

	<!-- FOOTER -->
	<?php $this->load->view("v_footer"); ?>
	<!-- FOOTER END -->

	<script src="<?= base_url('/assets/js/script.js') ?>"></script>
	
</body>
</html>