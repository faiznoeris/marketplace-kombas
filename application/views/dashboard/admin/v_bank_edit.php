<!-- Main content -->
<div class="content-wrapper">


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Edit Bank</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Admins/editbank/'.$data_bank->id_bank); ?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data bank</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Bank</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" value="<?= $data_bank->nama_bank ?>" name="nama_bank">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">No. Rekening</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" value="<?= $data_bank->no_rekening ?>" name="no_rekening">
							</div>
						</div>


						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<a href="<?= base_url('dashboard/bank') ?>" class="btn btn-link">Batal</a>
							<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- /form horizontal -->



		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content