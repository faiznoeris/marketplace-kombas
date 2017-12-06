<div class="container">

	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('account') ?>">My Account</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('account') ?>">Alamat</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $alamat->namaalamat ?></li>
			<li class="breadcrumb-item active" aria-current="page">Ubah Alamat</li>
		</ol>
	</nav>

	<br>

	<form method="post" action="<?php echo base_url('Address/edit/'.$alamat->id_alamat);?>" id="needs-validation" novalidate>

		<div class="form-group row">
			<label for="namaalamat" class="col-3 col-form-label">Nama Alamat</label>
			<div class="col-9">
				<input class="form-control" type="text" value="<?= $alamat->namaalamat ?>" id="namalamat" name="nama_alamat" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="atasnama" class="col-3 col-form-label">Atas Nama</label>
			<div class="col-9">
				<input class="form-control" type="text" value="<?= $alamat->atasnama ?>" id="atasnama" name="atas_nama" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="alamat" class="col-3 col-form-label">Alamat</label>
			<div class="col-9">
				<textarea class="form-control" type="text" id="alamat" name="alamat" rows="5" required><?= $alamat->alamat ?></textarea>
			</div>
		</div>

		<div class="form-group row">
			<label for="kecamatan" class="col-3 col-form-label">Kecamatan</label>
			<div class="col-9">
				<select class="form-control w-25" id="kecamatan" name="kecamatan" required>
					<option><?= $alamat->negara ?></option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="kabupaten" class="col-3 col-form-label">Kabupaten</label>
			<div class="col-9">
				<select class="form-control w-25" id="kabupaten" name="kabupaten" required>
					<option><?= $alamat->negara ?></option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="provinsi" class="col-3 col-form-label">Provinsi</label>
			<div class="col-9">
				<select class="form-control w-25" id="provinsi" name="provinsi" required>
					<option><?= $alamat->provinsi ?></option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="negara" class="col-3 col-form-label">Negara</label>
			<div class="col-9">
				<select class="form-control w-25" id="negara" name="negara" required>
					<option><?= $alamat->negara ?></option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="kodepos" class="col-3 col-form-label">Kode Pos</label>
			<div class="col-9">
				<input class="form-control" type="number" value="<?= $alamat->kodepos ?>" id="kodepos" name="kodepos" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="telephone" class="col-3 col-form-label">Telephone</label>
			<div class="col-9">
				<input class="form-control" type="number" value="<?= $alamat->telephone ?>" id="telephone" name="telephone" required>
			</div>
		</div>

		<center>
			<button class="btn btn-lg btn-primary btn-block w-25" type="submit">Simpan</button>
		</center>
	</form>
</div>