<div class="content">

	<!-- Cover area --> 
	<div class="panel panel-remove-outline profile-cover">
		<div class="profile-cover-img" style="background-image: url(<?= base_url($user_data->cover_path) ?>)"></div>
		<div class="media">

			<div class="media-body">
				<h1><?= $user_data->first_name." ".$user_data->last_name ?> <small class="display-block"><?= $user_lvl_name ?></small></h1>
			</div>
		</div>
	</div>
	<!-- /cover area -->

	<!-- User profile -->
	<div class="row">

		<div class="col-lg-3">

			<!-- User thumbnail -->
			<div class="thumbnail">
				<div class="thumb thumb-slide">
					<img src="<?= base_url($user_data->ava_path) ?>" alt="">

				</div>

				<div class="caption text-center">
					<h6 class="text-semibold no-margin">
						<?= $user_data->first_name." ".$user_data->last_name ?>
						<small class="display-block"></small><br>
						<a href="<?= base_url("account/messages/new/".$user_data->id_user) ?>" class="media-heading">
							<span class="text-semibold"><i class="icon-mail5 text-left"></i> Kirim Pesan</span>
						</a>
					</h6>

				</div>
			</div>
			<!-- /user thumbnail -->


		</div>

		<div class="col-lg-9">
			<div class="row tabbable">
				<div class="tab-content">
					
					<?php 
					$i = 0;
					$harga_reseller = 0;
					$harga_promo = 0;
					$diskon_reseller = 0;
					$diskon_promo = 0;
					$whobuy = "";
					?>

					<?php foreach ($results as $items): ?>

						<?php if($i < 8): ?>

							<?php 
							$i++;

							$category = $this->M_Index->data_productview_getcategory($items->id_category)->row()->nama_category;
							$totalreview = $this->M_Index->data_productview_getreview($items->id_product)->num_rows();
							$tokobuka = $this->M_Index->data_productview_getshop($items->id_shop)->row()->toko_buka;

							$data_bintang1	= 	$this->M_Index->data_productview_getreview_bintang("satu", $items->id_product)->row()->bintang_satu;
							$data_bintang2 	= 	$this->M_Index->data_productview_getreview_bintang("dua", $items->id_product)->row()->bintang_dua;
							$data_bintang3 	= 	$this->M_Index->data_productview_getreview_bintang("tiga", $items->id_product)->row()->bintang_tiga;
							$data_bintang4 	= 	$this->M_Index->data_productview_getreview_bintang("empat", $items->id_product)->row()->bintang_empat;
							$data_bintang5 	= 	$this->M_Index->data_productview_getreview_bintang("lima", $items->id_product)->row()->bintang_lima;

							if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $items->discount_reseller != 0){
								$diskon_reseller = $items->harga * $items->discount_reseller;
								$diskon_reseller = $diskon_reseller / 100;
								$harga_reseller = $items->harga - $diskon_reseller;

								$whobuy = "reseller";
							}else{
								$harga_reseller = $items->harga;

								$whobuy = "reguler";
							}

							if($items->promo_aktif == '1' && $items->discount_promo != 0){
								$diskon_promo = $items->harga * $items->discount_promo;
								$diskon_promo = $diskon_promo / 100;
								$harga_promo = $items->harga - $diskon_promo;	

								$whobuy = "promo";
							}else{
								$harga_promo = $items->harga;

								$whobuy = "reguler";
							}


							if($totalreview != 0){
								$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);

								$width_bintang_lima = $data_bintang5 * 100 / $totalreview;
								$width_bintang_empat = $data_bintang4 * 100 / $totalreview;
								$width_bintang_tiga = $data_bintang3 * 100 / $totalreview;
								$width_bintang_dua = $data_bintang2 * 100 / $totalreview;
								$width_bintang_satu = $data_bintang1 * 100 / $totalreview;

							}else{
								$percentage = 0;

								$width_bintang_lima = 0;
								$width_bintang_empat = 0;
								$width_bintang_tiga = 0;
								$width_bintang_dua = 0;
								$width_bintang_satu = 0;
							}

							if($percentage < 1){
								$bintang = '<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage < 2){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage < 3){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage < 4){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage < 5){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage < 6){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>';
							}

							?>
							<div class="col-lg-3 col-sm-6">
								<div class="panel">
									<div class="panel-body">
										<?php if($tokobuka != 1): ?>
											<span class="label label-flat border-warning text-warning-600 pull-right">Toko Sedang Tutup</span>

										<?php endif; ?>
										<br><br>
										<div class="thumb thumb-fixed">

											<a href="<?= base_url($items->sampul_path) ?>" data-popup="lightbox">
												<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
												<span class="zoom-image"><i class="icon-zoomin3"></i></span>
											</a>

										</div>
									</div>

									<div class="panel-body panel-body-accent text-center">
										<h6 class="text-semibold no-margin" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="<?= base_url("product/".$items->nama_product) ?>" class="text-default"><?= $items->nama_product ?></a></h6>

										<ul class="list-inline list-inline-separate mb-10">
											<li><a href="<?= base_url('shopping/category/'.$category) ?>" class="text-muted"><?= $category ?></a></li>
										</ul>

										<?php if($items->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5): ?>

											<h3 class="no-margin text-semibold">
												Rp. <?= number_format($harga_promo, 0, ',', '.') ?>
												<strike style="font-size: 15px;">Rp. <?= number_format($items->harga, 0, ',', '.') ?></strike>
											</h3>

										<?php elseif(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5): ?>

											<h3 class="no-margin text-semibold">Rp. <?= number_format($harga_reseller, 0, ',', '.') ?></h3>

										<?php else: ?>

											<h3 class="no-margin text-semibold">Rp. <?= number_format($items->harga, 0, ',', '.') ?></h3>

										<?php endif; ?>

										<div class="text-nowrap">
											<?= $bintang ?>
										</div>

										<div class="text-muted"><?= $totalreview ?> ulasan</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>	

				</div>
			</div>
			<center><?= $links ?></center>
		</div>


	</div>
	<!-- /user profile -->


</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
