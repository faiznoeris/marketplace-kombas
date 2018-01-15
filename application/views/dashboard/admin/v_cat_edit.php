<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Category</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active"><a href="<?= base_url('dashboard/category') ?>">Daftar Category</a></li>
				<li class="active">Edit Category</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Edit Category</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/editcategory/'.$data_category->id_category); ?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data Category</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Category</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" maxlength="12" value="<?= $data_category->nama_category ?>" name="nama_category">
							</div>
						</div>


						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
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
<!-- /page content