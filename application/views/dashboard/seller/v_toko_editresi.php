<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Update Resi</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active"><a href="<?= base_url('dashboard/toko') ?>">Toko</a></li>
				<li class="active">Update Resi</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Update Resi</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Pembelian/updateresi/'.$this->uri->segment(4));?>">


					<div class="form-group">
						<label class="control-label col-lg-2">Update Resi</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="resi" value="<?= $data_trans->resi ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama Pembeli</label>
						<div class="col-lg-10">
							<?= $data_trans->first_name." ".$data_trans->last_name ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama Barang</label>
						<div class="col-lg-10">
							<?= $data_trans->nama_product ?>
						</div>
					</div>

					<label class="left">
						<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
					</label>

					<label class="left">
						<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
					</label>

					<div class="text-right">
						<button type="submit" class="btn btn-primary" id="btnsubmit">Update Resi</button>
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