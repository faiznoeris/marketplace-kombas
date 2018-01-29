<div id="jGrowl-shop-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Toko</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Toko</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">




		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Setting Toko</b></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>



			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/edittoko/'.$data_shop->id_shop);?>">

					<div class="form-group">
						<label class="control-label col-lg-2">Toko Sedang Buka</label>
						<div class="col-lg-10">
							<div class="checkbox checkbox-switchery">
								<label>
									<?php if($data_shop->toko_buka == "1"): ?>
										<input type="checkbox" class="switchery" checked="checked" name="toko_buka">
									<?php else: ?>
										<input type="checkbox" class="switchery" name="toko_buka">
									<?php endif ?>
								</label>
							</div>
						</div>
					</div>

					<?php

					//RAJA ONGKIR API GET KOTA

					$curl = curl_init();	
					curl_setopt_array($curl, array(
						CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
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
						<label class="control-label col-lg-2">Kota Asal Toko</label>
						<div class="col-lg-10">
							<select name="kota_asal" class="form-control">
								<?php
								for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
									if($data['rajaongkir']['results'][$i]['city_id'] == $data_shop->kota_asal){
										echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."' selected>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
									}else{
										echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
									}
									
								}
								?>			
							</select>
						</div>
					</div>

					<?php 

					$kurir = explode(',',$data_shop->kurir);

					?>

					<div class="form-group">
						<label class="control-label col-lg-2">Kurir</label>
						<div class="col-lg-10">

							<?php if((!empty($kurir[0]) && $kurir[0] == 'jne')|| (!empty($kurir[1]) && $kurir[1] == 'jne') || (!empty($kurir[2]) && $kurir[2] == 'jne') || (!empty($kurir[3]) && $kurir[3] == 'jne')): ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" checked name="jne">
									JNE
								</label>

							<?php else: ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" name="jne">
									JNE
								</label>
							<?php endif; ?>
							

							<?php if((!empty($kurir[0]) && $kurir[0] == 'tiki')|| (!empty($kurir[1]) && $kurir[1] == 'tiki') || (!empty($kurir[2]) && $kurir[2] == 'tiki') || (!empty($kurir[3]) && $kurir[3] == 'tiki')): ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" checked name="tiki">
									TIKI
								</label>

							<?php else: ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" name="tiki">
									TIKI
								</label>
							<?php endif; ?>

							<?php if((!empty($kurir[0]) && $kurir[0] == 'pos')|| (!empty($kurir[1]) && $kurir[1] == 'pos') || (!empty($kurir[2]) && $kurir[2] == 'pos') || (!empty($kurir[3]) && $kurir[3] == 'pos')): ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" checked name="pos">
									POS INDONESIA
								</label>

							<?php else: ?>
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" name="pos">
									POS INDONESIA
								</label>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Bank</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?= $data_shop->bank ?>" name="bank">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Rekening</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?= $data_shop->rekening ?>" name="rekening">
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