<!-- Content area -->
<div class="content">
	<div class="col-lg-9">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Menambahkan Product Baru</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/addproduct/'.$data_user["id_shop"]);?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data Product</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Product</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Masukkan nama product" name="nama_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Deskripsi Product</label>
							<div class="col-lg-10">
								<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" placeholder="Enter text ..." name="deskripsi_product">

								</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Kode Product (SKU)</label>
							<div class="col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan kode product" name="kode_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Stok Product</label>
							<div class="col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan jumlah total stok product tersedia" name="stok_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Harga Product</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan harga product" name="harga_product">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-2">Diskon Reseller (%)</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan diskon reseller" name="discount_reseller">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Diskon Promo (%)</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan diskon promo" name="discount_promo">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-lg-2">Promo Aktif (ON/OFF)</label>
							<div class="col-lg-10">
								<div class="checkbox checkbox-switchery">
									<label>
										<input type="checkbox" class="switchery" name="promo_aktif">
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Berat Product (gram)</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan berat product" name="berat_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Product Category</label>
							<div class="col-lg-10">
								<select name="category" class="form-control">
									<?php foreach ($data_cat as $row): ?>
										<option value="<?= $row->id_category ?>"><?= $row->nama_category ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri Product <span style="color: red">(gambar pertama akan dijadikan sampul)</span></label>
							<div class="col-lg-10">
								<div class="dropzone" id="dropzone_galeri"></div>
							</div>
							<input type="hidden" id="id_user" value="<?= $this->session->userdata('id_user') ?>">
						</div>

						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="btnsubmit">Tambahhkan <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<!-- Navigation -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Navigation</h6>
				</div>

				<div class="list-group no-border no-padding-top">
					<a href="<?= base_url('account/profile') ?>" class="list-group-item"><i class="icon-user"></i> My profile</a>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-cash3"></i> Riwayat saldo</a>
					<a href="<?= base_url('account/messages') ?>" class="list-group-item"><i class="icon-bubbles7"></i> Pesan</a>
					<?php if($user_lvl_name == "Seller"): ?>
						<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-store2"></i> Toko </a>
					<?php else: ?>
						<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-location4"></i> Alamat </a>
					<?php endif; ?>
					
					<?php if($user_lvl_name == "Seller"): ?>
						<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Penjualan <span class="badge bg-teal-400 pull-right">48</span></a>
					<?php else: ?>
						<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Pembelian <span class="badge bg-teal-400 pull-right">48</span></a>
					<?php endif; ?>

					<?php if($user_lvl_name != "Seller"): ?>

						<div class="list-group-divider"></div>

						<a data-toggle="modal" class="list-group-item" data-target="#modal_req_seller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Seller</span></a>

						<a data-toggle="modal" class="list-group-item" data-target="#modal_req_reseller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Re-seller</span></a>

						<div class="list-group-divider"></div>

					<?php endif; ?>

					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" "><i class="icon-cog3"></i> Pengaturan akun</a>
				</div>
			</div>
			<!-- /navigation -->
		</div>
	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
