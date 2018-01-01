<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Alamat</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active"><a href="<?= base_url('dashboard/alamat') ?>">Daftar Alamat</a></li>
				<li class="active">Edit Alamat</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Edit Alamat</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Address/edit/'.$alamat->id_alamat);?>">
					<fieldset class="content-group">
						<legend class="text-bold">Data Alamat</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Alamat</label>
							<div class="col-lg-10">
								<input class="form-control" type="text" value="<?= $alamat->namaalamat ?>" id="namalamat" name="nama_alamat" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Atas Nama</label>
							<div class="col-lg-10">
								<input class="form-control" type="text" value="<?= $alamat->atasnama ?>" id="atasnama" name="atas_nama" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Alamat</label>
							<div class="col-lg-10">
								<textarea class="form-control" type="text" id="alamat" name="alamat" rows="5" required><?= $alamat->alamat ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Single select</label>
							<div class="col-lg-10">
								<select name="select" class="form-control">
									<option value="opt1">Default select height</option>
									<option value="opt2">Option 2</option>
									<option value="opt3">Option 3</option>
									<option value="opt4">Option 4</option>
									<option value="opt5">Option 5</option>
									<option value="opt6">Option 6</option>
									<option value="opt7">Option 7</option>
									<option value="opt8">Option 8</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Single select</label>
							<div class="col-lg-10">
								<select name="select" class="form-control">
									<option value="opt1">Default select height</option>
									<option value="opt2">Option 2</option>
									<option value="opt3">Option 3</option>
									<option value="opt4">Option 4</option>
									<option value="opt5">Option 5</option>
									<option value="opt6">Option 6</option>
									<option value="opt7">Option 7</option>
									<option value="opt8">Option 8</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Kode Pos</label>
							<div class="col-lg-10">
								<input class="form-control" type="number" value="<?= $alamat->kodepos ?>" id="kodepos" name="kodepos" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Telephone</label>
							<div class="col-lg-10">
								<input class="form-control" type="number" value="<?= $alamat->telephone ?>" id="telephone" name="telephone" required>
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