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

	<!-- Modal JS -->

	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/notifications/bootbox.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/notifications/sweet_alert.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/plugins/forms/selects/select2.min.js') ?>"></script>
	
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/core/app.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/dashboard-limitless/js/pages/components_modals.js') ?>"></script>

	<!-- /modal JS -->

	<!-- Theme JS files -->
	<?php $this->load->view($jstheme); ?>
	<?php if(isset($jstheme2)) $this->load->view($jstheme2) ?>
	<?php if(isset($jstheme3)) $this->load->view($jstheme3) ?>
	<?php if(isset($jstheme4)) $this->load->view($jstheme4) ?>
	<?php if(isset($jstheme5)) $this->load->view($jstheme5) ?>
	<!-- /theme JS files -->

	<script type="text/javascript">
		$(document).ready(function(){
			$('#provinsi').change(function(){

				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
				var prov = $('#provinsi').val();

				// alert(prov);

				$.ajax({
					type : 'GET',
					url : 'http://localhost/ecommerce/Index/cekkabupaten/' + prov,
					// data :  'prov_id=' + prov,
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							// alert(prov);
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#kabupaten").html(data.options);
						}else{
							// alert('aa');
						}
					}
				});
			});
		});

		(function($){
			$(function(){

				var notif = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif.'.$_SESSION['id_user']); }else{ echo 'false'; }?>";
				var notif_header = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_header.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				var notif_message = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_message.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				var notif_duration = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_duration.'.$_SESSION['id_user']); }else{ echo 0; }?>";
				var notif_theme = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_theme.'.$_SESSION['id_user']); }else{ echo 'bg-primary'; }?>";
				var notif_sticky = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_sticky.'.$_SESSION['id_user']); }else{ echo 'false'; }?>";
				var notif_container = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_container.'.$_SESSION['id_user']); }else{ echo ''; }?>";
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


				// for (var i=0; i<10; i++) {
				// 	setTimeout(function(){
				// 		var alertType = alertTypes[Math.floor(Math.random()*alertTypes.length)];
				// 		$('#jGrowl-container1').jGrowl({
				// 			header: alertType.substring(0, 1).toUpperCase() + alertType.substring(1) + ' Notification',
				// 			message: 'Hello world ',
				// 			group: 'alert-' + alertType,
				// 			life: 5000
				// 		});
				// 	}, i*2000);
				// }
			});
		})(jQuery);
	</script>

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
