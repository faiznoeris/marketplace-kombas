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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url('/assets/css/template.css') ?>">
	<!-- Iconic CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/open-iconic-master/font/css/open-iconic-bootstrap.css') ?>">
	<!-- FontAwesome CSS -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

	<!-- NAVBAR CONTENT -->
	<?php $this->load->view("v_navbar"); ?>
	<!-- NAVBAR END -->

	<!-- PAGE CONTENT -->
	<?php $this->load->view($content); ?>
	<!-- PAGE CONTENT END -->

	<!-- FOOTER -->
	<?php $this->load->view("v_footer"); ?>
	<!-- FOOTER END -->

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?= base_url('/assets/js/jquery-3.2.1.min.js') ?>" ></script>
	<script src="<?= base_url('/assets/js/popper.min.js') ?>" ></script>
	<script src="<?= base_url('/assets/js/bootstrap.min.js') ?>" ></script>
	<!-- Angular JS -->
	<script src="<?= base_url('/assets/js/angular.min.js') ?>"></script>
	<!-- Holder JS -->
	<script src="https://getbootstrap.com/assets/js/vendor/holder.min.js" ></script>
	<!-- Hoover Zoom (Product Details) JS -->
	<script src="<?= base_url('/assets/js/hoverzoom.js') ?>"></script>
	<!-- Custom Script JS -->
	<script src="<?= base_url('/assets/js/script.js') ?>"></script>


	<script type="text/javascript">

		$(document).ready(function(){
			$('#alamat').change(function(){
				var id = $('#alamat').val();

				// alert(prov);

				$.ajax({
					type : 'GET',
					url : 'http://localhost/ecommerce/Index/getalamat/' + id,
					// data :  'prov_id=' + prov,
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							// alert(prov);
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#alamatbox").html(data.options);
						}else{
							// alert('aa');
						}
					}
				});
			});

			// $('#kurir').val('jne').trigger('change');

			$('.kurir').change(function(){
				// alert('aa');
				var id = this.value;

				var id = id.split("|");

				

				$.ajax({
					type : 'GET',
					url : 'http://localhost/ecommerce/Index/getongkir/' + id[0] + '/' + id[1] + '/' + id[2] + '/' + id[3] + '/' + id[4],
					// data :  'prov_id=' + prov,
					dataType: 'json',
					success: function (data) {
						if (data.success) {
							// alert(prov);
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#ongkir_"+id[4]).html(data.options);
							// alert(id[4]);
						}else{
							// alert('aa');
						}
					}
				});
			});

		});


	</script>
</body>
</html>