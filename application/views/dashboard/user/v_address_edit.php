<div id="jGrowl-address-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Basic modal -->
<div id="modal_req_seller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradeseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Basic modal -->
<div id="modal_req_reseller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradereseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
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
				<form class="form-horizontal" method="post" action="<?php echo base_url('Address/edit/'.$alamat->id_address);?>">
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

						<?php

						//RAJA ONGKIR API GET PROVINSI

						$curl = curl_init();	
						curl_setopt_array($curl, array(
							CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_HTTPHEADER => array(
								"key: e5629870cbd922e9156805e0ffe6625c"
							),
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						$data = json_decode($response, true);


						$provinsi_id = "";
						?> 


						<div class="form-group">
							<label class="control-label col-lg-2">Provinsi</label>
							<div class="col-lg-10">
								<select name="provinsi" class="form-control" id="provinsi">
									<?php
									for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
										if($data['rajaongkir']['results'][$i]['province_id'] == $alamat->provinsi){
											echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."' selected>".$data['rajaongkir']['results'][$i]['province']."</option>";
											$provinsi_id = $data['rajaongkir']['results'][$i]['province_id'];
										}else{
											echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
										}

									}
									?>			
								</select>
							</div>
						</div>

						<?php

						//RAJA ONGKIR API GET KABUPATEN

						$curl = curl_init();	
						curl_setopt_array($curl, array(
							CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$provinsi_id,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_HTTPHEADER => array(
								"key: e5629870cbd922e9156805e0ffe6625c"
							),
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						$data = json_decode($response, true);
						?> 

						<div class="form-group">
							<label class="control-label col-lg-2">Kabupaten</label>
							<div class="col-lg-10">
								<select name="kabupaten" class="form-control" id="kabupaten">
									<?php
									for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
										if($data['rajaongkir']['results'][$i]['city_id'] == $alamat->provinsi){
											echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."' selected>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
										}else{
											echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
										}

									}
									?>
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