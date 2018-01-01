<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Product</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li>Daftar Product</li>
				<li class="active">Edit Product</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Mengubah Data Product</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/addproduct/');?>">
					<fieldset class="content-group">
						<legend class="text-bold">Data Product</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Product</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" maxlength="12" placeholder="<?= $data_product->nama_product ?>" name="nama_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Deskripsi Product</label>
							<div class="col-lg-10">
								<textarea rows="5" cols="5" class="form-control" placeholder="<?= $data_product->deskripsi_product ?>" name="deskripsi_product"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Harga Product</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="<?= $data_product->harga ?>" name="harga_product">
							</div>
						</div>

						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan <i class="icon-arrow-right14 position-right"></i></button>
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