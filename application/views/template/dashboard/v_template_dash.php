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

	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/core/app.js') ?>"></script>

	<!-- Modal JS -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/bootbox.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/sweet_alert.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/selects/select2.min.js') ?>"></script>
	
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/components_modals.js') ?>"></script>
	<!-- /modal JS -->


	<!-- Notification -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/pnotify.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/noty.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/jgrowl.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/components_notifications_other.js') ?>"></script>
	<!-- Notification -->

	<!-- Theme JS files -->
	<?php 
	if(isset($jstheme)){
		foreach ($jstheme as $js) {
			$this->load->view($js);
		}
	}
	?>

	<!-- /theme JS files -->

	<script type="text/javascript">

		(function($){
			$(function(){

				var notif = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif.'.$_SESSION['id_admin']); }else{ echo 'false'; }?>";
				var notif_header = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_header.'.$_SESSION['id_admin']); }else{ echo ''; }?>";
				var notif_message = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_message.'.$_SESSION['id_admin']); }else{ echo ''; }?>";
				var notif_duration = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_duration.'.$_SESSION['id_admin']); }else{ echo 0; }?>";
				var notif_theme = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_theme.'.$_SESSION['id_admin']); }else{ echo 'bg-primary'; }?>";
				var notif_sticky = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_sticky.'.$_SESSION['id_admin']); }else{ echo 'false'; }?>";
				var notif_container = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_container.'.$_SESSION['id_admin']); }else{ echo ''; }?>";
				// var alertTypes = ['success', 'info', 'warning', 'danger']; 
				var notif_group = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_group.'.$_SESSION['id_user']); }else{ echo ''; }?>";


				if (notif) {
					$(notif_container).jGrowl({
						header: notif_header,
						message: notif_message,
						theme:  notif_theme,
						sticky: notif_sticky,
						group: notif_group,
						life: notif_duration
					});
				}
			});
		})(jQuery);
	</script>

</head>

<body class="navbar-bottom">

	<?php $this->load->view("template/dashboard/v_navbar_dash"); ?>

	<div id="jGrowl-<?= $this->session->userdata('id_admin') ?>" class="jGrowl top-center"></div>

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<?php $this->load->view($content); ?>

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<!-- Footer -->
	<div class="navbar navbar-default navbar-fixed-bottom footer">
		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="footer">
			<div class="navbar-text">
				&copy; 2018. <a href="<?= base_url('') ?>"><?= $webname ?></a>
			</div>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<!-- <li><a href="#">About</a></li>
					<li><a href="#">Terms</a></li>
					<li><a href="#">Contact</a></li> -->
				</ul>
			</div>
		</div>
	</div>
	<!-- /footer -->

</body>
</html>
