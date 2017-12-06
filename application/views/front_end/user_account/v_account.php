<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container h-100">
	<div class="row row-offcanvas row-offcanvas-left">

		<div class="col-4 col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar">
			<ul class="nav flex-column pl-1" id="sidebartab" role="tablist">
				<li class="nav-item active">
					<a class="nav-link" data-toggle="tab" href="#biodata" role="tab">Biodata Diri</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#alamat" role="tab">Alamat</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#pembelian" role="tab" onclick="$('#sidebar').tab('hide')">Pembelian</a>
				</li>
			</ul>
		</div>
		<!--/col-->

		<div class="tab-content col-8 col-md-9 col-lg-10 sidebar-offcanvas">
			<div class="tab-pane" id="alamat" role="tabpanel">

				<h3 class="title-median" style="color: black !important; font-size: 25px; font-weight: 600;">Alamat Terdaftar</h3>
				<br>
				<a href="<?= base_url('account/alamat/tambahalamat') ?>">Tambah Alamat</a>
				<br>
				<?php if(!empty($alamat)): ?>

					<?php foreach ($alamat as $row) { ?>

					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<h4 class="card-title"><?= $row->namaalamat ?></h4>
							<h6 class="card-subtitle mb-2 text-muted">a.n <?= $row->atasnama ?></h6>
							<p class="card-text"><b>Alamat:</b><br><?= $row->alamat ?><br><br><b>Telephone:</b><br><?= $row->telephone ?></p>
							<a href="<?= base_url('account/alamat/ubahalamat/'. $row->id_alamat) ?>" class="card-link">Ubah Alamat</a>
							<a href="<?= base_url('Address/delete/'. $row->id_alamat) ?>" class="card-link">Hapus Alamat</a>
						</div>
					</div>

					<?php } ?>

				<?php else: ?>
					<br><br><p>Alamat anda masih kosong!</p>
				<?php endif; ?>
				


				

				

			</div>

			<div class="tab-pane" id="pembelian" role="tabpanel">

				<ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Status Pembayaran</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Status Pemesanan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Konfirmasi Penerimaan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Riwayat Transaksi</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active show" id="tabs-1" role="tabpanel">Tab 1 content</div>
					<div class="tab-pane" id="tabs-2" role="tabpanel">Tab 2 content</div>
					<div class="tab-pane" id="tabs-3" role="tabpanel">Tab 3 content</div>
					<div class="tab-pane" id="tabs-4" role="tabpanel">Tab 4 content</div>
				</div>

			</div>

			<div class="tab-pane active" id="biodata" role="tabpanel">

				
				<form method="post" action="<?php echo base_url('Account/saveprofile/');?>">
					<h3 class="title-median" style="color: black !important; font-size: 25px; font-weight: 600;">Biodata Diri</h3>

					<br>

					<div class="form-group row">
						<label for="validationCustom01" class="col-3 col-form-label">First Name</label>
						<div class="col-3">
							<input class="form-control" type="text" id="validationCustom01" value="<?= $user->first_name ?>" name="first_name">
						</div>
						<label for="validationCustom02" class="col-3 col-form-label">Last Name</label>
						<div class="col-3">
							<input class="form-control" type="text" id="validationCustom02" value="<?= $user->last_name ?>" name="last_name">
						</div>
					</div>

					<div class="form-group row">
						<label for="validationCustom03" class="col-3 col-form-label">Username</label>
						<div class="col-9">
							<input class="form-control" type="text" value="<?= $user->username ?>" id="validationCustom03" name="username">
						</div>
					</div>

					<div class="form-group row">
						<label for="validationCustom04" class="col-3 col-form-label">Email</label>
						<div class="col-9">
							<input class="form-control" type="email" value="<?= $user->email ?>" id="validationCustom04" name="email">
						</div>
					</div>
					<div class="form-group row">
						<label for="validationCustom05" class="col-3 col-form-label">Telephone</label>
						<div class="col-9">
							<input class="form-control" type="tel" value="<?= $user->telephone ?>" id="validationCustom05" name="telephone">
						</div>
					</div>
					<div class="form-group row">
						<label for="validationCustom06" class="col-3 col-form-label">Password</label>
						<div class="input-group col-9">
							<input class="form-control pwd" type="password" placeholder="*******" id="validationCustom06" name="password">
							<span class="input-group-btn">
								<button class="btn btn-default reveal" type="button"><span class="oi oi-eye"></span></button>
							</span>          
						</div>
					</div>


					<label class="left">
						<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
					</label>

					<br><br>
					<center>
						<button class="btn btn-lg btn-primary btn-block w-25" type="submit" id="btnsave">Save</button>
					</center>
				</form>   
			</div>
		</div>

	</div>


</div>