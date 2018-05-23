<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="marketplace kombas">
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
	<!-- Slick Slider -->

	<!-- Theme JS files -->
	<?php if($active == "shopping" || $active =="search" || $active == "product"): ?>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/media/fancybox.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/ecommerce_product_list.js') ?>"></script>
	<?php endif; ?>
	<!-- /theme JS files -->

	<?php if($active == "product"): ?>
		<!-- Theme JS files -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switch.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/app.js') ?>"></script>
		


		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/selects/select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/moment/moment.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/fullcalendar/fullcalendar.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/echarts/echarts.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/user_pages_profile.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/ripple.min.js') ?>"></script>
		<!-- /theme JS files -->
	<?php endif; ?>

	<?php if($active == "search"): ?>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/app.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/components_dropdowns.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/ripple.min.js') ?>"></script>
	<?php endif; ?>

	<?php if($active == "account" || $active == "profile"): ?>
		<!-- Theme JS files -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switch.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/app.js') ?>"></script>
		


		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/tables/datatables/extensions/buttons.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/selects/select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/moment/moment.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/fullcalendar/fullcalendar.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/echarts/echarts.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/d3/d3.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/d3/d3_tooltip.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/general_widgets_stats.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/user_pages_profile.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/ecommerce_orders_history.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/ripple.min.js') ?>"></script>
		<!-- /theme JS files -->
	<?php endif; ?>

	<?php if($active == "addproduct"): ?>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/switch.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/wysihtml5.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/toolbar.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/parsers.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/jgrowl.min.js') ?>"></script>


		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/uploaders/dropzone.min.js') ?>"></script>

		<!-- <script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/core/app.js') ?>"></script> -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/uploader_dropzone.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/form_inputs.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/editor_wysihtml5.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/form_checkboxes_radios.js') ?>"></script>
	<?php endif; ?>

	<?php if($active == "editproduct"): ?>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/switch.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/wysihtml5.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/toolbar.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/parsers.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/media/fancybox.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/pnotify.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/noty.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/plugins/notifications/jgrowl.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/components_notifications_other.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/components_thumbnails.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/form_inputs.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/editor_wysihtml5.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_5/js/pages/form_checkboxes_radios.js') ?>"></script>
	<?php endif; ?>

	<?php if($active == "order"): ?>
		<!-- Theme JS files -->
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/wizards/steps.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/selects/select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/libraries/jasny_bootstrap.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/validation/validate.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/extensions/cookie.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switch.min.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/wizard_steps.js') ?>"></script>
		<!-- /theme JS files -->
	<?php endif; ?>

	<?php if($active == "alamat"): ?>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/uniform.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switchery.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/styling/switch.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/core/app.js') ?>"></script>
		
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/forms/selects/select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/moment/moment.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/fullcalendar/fullcalendar.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/visualization/echarts/echarts.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/user_pages_profile.js') ?>"></script>

		<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/ui/ripple.min.js') ?>"></script>
	<?php endif; ?>

	<!-- NOTIFICATION -->
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/notifications/pnotify.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/notifications/noty.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/plugins/notifications/jgrowl.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/assets/limitless_1/js/pages/components_notifications_other.js') ?>"></script>
	<!-- /NOTIFICATION -->

	<script type="text/javascript">
		(function($){
			$(function(){
				setInterval(check_cookies, 21600000); //6 hours in milisecondsss, check cookies if user not login clear cookies
				setInterval(check_resi, 43200000); //12 hours in milisecondss, check resi if delivered change the status to delivered
				setInterval(check_delivery_exceed_deadline, 43200000);
				setInterval(check_notif_msg, 1000);

				/* NOTIFICATION */

				var notif = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif.'.$_SESSION['id_user']); }else{ echo 'false'; }?>";
				var notif_header = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_header.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				var notif_message = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_message.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				var notif_duration = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_duration.'.$_SESSION['id_user']); }else{ echo 0; }?>";
				var notif_theme = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_theme.'.$_SESSION['id_user']); }else{ echo 'bg-primary'; }?>";
				var notif_sticky = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_sticky.'.$_SESSION['id_user']); }else{ echo 'false'; }?>";
				var notif_container = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_container.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				// var alertTypes = ['success', 'info', 'warning', 'danger']; 
				var notif_group = "<?php if(isset($_SESSION['username'])){ echo $this->session->tempdata('notif_group.'.$_SESSION['id_user']); }else{ echo ''; }?>";
				var notif_click = "";


				if (notif) {
					$(notif_container).jGrowl({
						header: notif_header,
						message: notif_message,
						theme:  notif_theme,
						sticky: notif_sticky,
						group: notif_group,
						life: notif_duration,
						// click: function(msg) {
						// 	alert("You clicked me");
						// }
					});
				}

				/* NOTIFICATION */
			});
			
			function check_notif_msg(){
				var id_user = "<?php if(isset($_SESSION['username'])){ echo $this->session->userdata('id_user'); }else{ echo ''; }?>";
				$.ajax({
					type : 'GET',
					url : 'http://marketplace-kombas.com/Ajax/ceknotifmsg/'+id_user,
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							$(data.notif_container).jGrowl({
								header: data.notif_header,
								message: data.notif_message,
								theme:  data.notif_theme,
								sticky: data.notif_sticky,
								group: data.notif_group,
								life: data.notif_duration
							});
							$('#chatbox').append(data.options);
						}else{
							// alert('false');
						}
					}
				});
			}

			function check_delivery_exceed_deadline(){
				$.ajax({
					type : 'GET',
					url : 'http://marketplace-kombas.com/Ajax/cekdeliverydeadline/',
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							// alert("oK");
						}else{
							// alert('false');
						}
					}
				});
			}

			function check_resi(){
				$.ajax({
					type : 'GET',
					url : 'http://marketplace-kombas.com/Ajax/cekresi/',
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							// alert(data.options);
						}else{
							// alert('false');
						}
					}
				});
			}

			function check_cookies(){
				var date = "<?php echo date('Y-m-d'); ?>";
				var token = '<?php echo get_cookie("token") ?>';

				$.ajax({
					type : 'GET',
					url : 'http://marketplace-kombas.com/Ajax/cektoken/' + token,
					dataType: 'json',
					success: function (data) {
						// alert(token);
						// if (data.success) {
						// 	if(data.date == date){
						// 		alert('SAME!');
						// 	}else{
						// 		alert('different :( ' + date + " - " + data.date);
						// 	}
						// }else{
						// 	alert('FAIL! :(');
						// }
					}
				});
			}
		})(jQuery);
	</script>

</head>
<body class="has-detached-right" style="background-image: url('<?= base_url("assets/images/backgrounds/seamless.png") ?>');">

	<?php if($loggedin): ?>
		<div id="jGrowl-<?= $this->session->userdata('id_user') ?>" class="jGrowl top-center"></div>
	<?php endif; ?>

	<!-- NAVBAR CONTENT -->
	<?php $this->load->view("template/v_navbar"); ?>
	<!-- NAVBAR END -->

	<?php if($active == "alamat" || $active == "account" && $loggedin): ?>
		<!-- Basic modal -->
		<div id="modal_req_seller_<?= $this->session->userdata('id_user') ?>" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Request Approval Menjadi Seller</h5>
					</div>

					<div class="modal-body">
						<!-- <h6 class="text-semibold">Text in a modal</h6> -->
						<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						<a href="<?= base_url('Account/upgradeseller/'.$this->session->userdata('id_user')) ?>" class="btn btn-primary">Confirm</a>

					</div>
				</div>
			</div>
		</div>
		<!-- /basic modal -->
		<!-- Basic modal -->
		<div id="modal_req_reseller_<?= $this->session->userdata('id_user') ?>" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
					</div>

					<div class="modal-body">
						<!-- <h6 class="text-semibold">Text in a modal</h6> -->
						<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						<a href="<?= base_url('Account/upgradereseller/'.$this->session->userdata('id_user')) ?>" class="btn btn-primary">Confirm</a>

					</div>
				</div>
			</div>
		</div>
		<!-- /basic modal -->
	<?php endif; ?>

	<!-- PAGE CONTENT -->
	<?php $this->load->view($content); ?>
	<!-- PAGE CONTENT END -->

	<!-- FOOTER -->
	<?php $this->load->view("template/v_footer"); ?>
	<!-- FOOTER END -->

	<script src="<?= base_url('/assets/js/script.js') ?>"></script>
	
</body>
</html>