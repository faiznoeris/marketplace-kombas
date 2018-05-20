<div class="content">

	<div class="row">
		<div class="col-lg-9">
			<!-- Account Settings -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Tambah Alamat &nbsp; <i class="icon-location4"></i></h6>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url('Address/add/');?>">
					<fieldset class="content-group">

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Alamat</label>
							<div class="col-lg-10">
								<input class="form-control" type="text" value="" id="namalamat" name="nama_alamat" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Atas Nama</label>
							<div class="col-lg-10">
								<input class="form-control" type="text" value="" id="atasnama" name="atas_nama" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Alamat</label>
							<div class="col-lg-10">
								<textarea class="form-control" type="text" id="alamat" name="alamat" rows="5" required></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Provinsi</label>
							<div class="col-lg-10">
								<select name="provinsi" class="form-control" id="provinsi">
									<?php
									for ($i=0; $i < count($rajaongkir_provinsi['rajaongkir']['results']); $i++) { 
										// if($data['rajaongkir']['results'][$i]['province_id'] == $data_shop->kota_asal){
										// 	echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."' selected>".$data['rajaongkir']['results'][$i]['province']."</option>";
										// }else{
											echo "<option value='".$rajaongkir_provinsi['rajaongkir']['results'][$i]['province_id']."'>".$rajaongkir_provinsi['rajaongkir']['results'][$i]['province']."</option>";
										// }

									}
									?>			
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Kabupaten</label>
							<div class="col-lg-10">
								<select name="kabupaten" class="form-control" id="kabupaten">
									
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Kode Pos</label>
							<div class="col-lg-10">
								<input class="form-control" type="number" value="" id="kodepos" name="kodepos" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Telephone</label>
							<div class="col-lg-10">
								<input class="form-control" type="number" value="" id="telephone" name="telephone" required>
							</div>
						</div>


						<label class="left">
							<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
						</label>

						<label class="left">
							<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
						</label>

						<div class="text-right">
							<a href="<?= base_url('account/profile#pengaturan') ?>" class="btn btn-link">Batal</a>
							<button type="submit" class="btn btn-primary" id="btnsubmit">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Account Settings -->
		<div class="col-lg-3">

			<!-- User thumbnail -->
			<div class="thumbnail">
				<div class="thumb thumb-slide">
					<img src="<?= base_url($data_user['ava_path']) ?>" alt="">

				</div>

				<div class="caption text-center">
					<h6 class="text-semibold no-margin">
						<?= $data_user["nama_lgkp"] ?>
						<small class="display-block"><?= $user_lvl_name ?></small>
						<small class="display-block">Rp. <?= number_format($user_data->saldo, 0, ',', '.') ?></small>
					</h6>

				</div>
			</div>
			<!-- /user thumbnail -->


			<!-- Navigation -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Navigation</h6>
				</div>

				<div class="list-group no-border no-padding-top">
					<a href="<?= base_url('account/profile') ?>" class="list-group-item"><i class="icon-user"></i> My profile</a>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-cash3"></i> Riwayat saldo</a>
					<?php if($user_lvl_name == "Seller"): ?>
						<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-store2"></i> Toko </a>
					<?php else: ?>
						<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-location4"></i> Alamat </a>
					<?php endif; ?>
					<!-- <div class="list-group-divider"></div> -->
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item" ><i class="icon-stack2"></i> Penjualan <span class="badge bg-teal-400 pull-right">48</span></a>
					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" "><i class="icon-cog3"></i> Pengaturan akun</a>
				</div>
			</div>
			<!-- /navigation -->


		</div>
	</div>

</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
