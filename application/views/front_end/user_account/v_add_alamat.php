<div class="container">

	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('account') ?>">My Account</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('account') ?>">Alamat</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tambah Alamat</li>
		</ol>
	</nav>

	<br>

	<form method="post" action="<?php echo base_url('Address/add/');?>" id="needs-validation" novalidate>

		<div class="form-group row">
			<label for="namaalamat" class="col-3 col-form-label">Nama Alamat</label>
			<div class="col-9">
				<input class="form-control" type="text" placeholder="Alamat Rumah" id="namalamat" name="nama_alamat" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="atasnama" class="col-3 col-form-label">Atas Nama</label>
			<div class="col-9">
				<input class="form-control" type="text" placeholder="Faiz Noeris" id="atasnama" name="atas_nama" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="alamat" class="col-3 col-form-label">Alamat</label>
			<div class="col-9">
				<textarea class="form-control" type="text" placeholder="Jalan Overste Isdiman No.33, Bancarkembar, Purwokerto Utara, Bancarkembar, Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53114" id="alamat" name="alamat" rows="5" required></textarea>
			</div>
		</div>

		<div class="form-group row">
			<label for="kecamatan" class="col-3 col-form-label">Kecamatan</label>
			<div class="col-9">
				<select class="form-control w-25" id="kecamatan" name="kecamatan" required>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="kabupaten" class="col-3 col-form-label">Kabupaten</label>
			<div class="col-9">
				<select class="form-control w-25" id="kabupaten" name="kabupaten" required>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="provinsi" class="col-3 col-form-label">Provinsi</label>
			<div class="col-9">
				<select class="form-control w-25" id="provinsi" name="provinsi" required>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="negara" class="col-3 col-form-label">Negara</label>
			<div class="col-9">
				<select class="form-control w-25" id="negara" name="negara" required>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="kodepos" class="col-3 col-form-label">Kode Pos</label>
			<div class="col-9">
				<input class="form-control" type="number" placeholder="53114" id="kodepos" name="kodepos" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="telephone" class="col-3 col-form-label">Telephone</label>
			<div class="col-9">
				<input class="form-control" type="number" placeholder="081221753835" id="telephone" name="telephone" required>
			</div>
		</div>

		<center>
			<button class="btn btn-lg btn-primary btn-block w-25" type="submit">Tambah</button>
		</center>
	</form>
</div>