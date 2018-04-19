<!-- Content area -->
<div class="content">	
	<div class="panel panel-remove-outline"> 
		<div class="row center-div" style="padding-top: 15px; padding-bottom: 15px;">
			<div class="col-lg-3 col-sm-12 center-div">
				<div class="your-class">

					<?php 
					$harga_reseller = 0;
					$harga_promo = 0;
					$diskon_reseller = 0;
					$diskon_promo = 0;
					$whobuy = "";
					?>

					<?php foreach ($data_promo as $items): ?>

						<?php 
						$category = $this->M_category->get($items->id_category)->row()->nama_category;
						$totalreview = $this->M_reviews->select($items->id_product)->nuM_rows();
						$tokobuka = $this->M_shop->selectidshop($items->id_shop)->row()->toko_buka;

						$data_bintang1	= 	$this->M_reviews->bintang_satu($items->id_product)->row()->bintang_satu;
						$data_bintang2 	= 	$this->M_reviews->bintang_dua($items->id_product)->row()->bintang_dua;
						$data_bintang3 	= 	$this->M_reviews->bintang_tiga($items->id_product)->row()->bintang_tiga;
						$data_bintang4 	= 	$this->M_reviews->bintang_empat($items->id_product)->row()->bintang_empat;
						$data_bintang5 	= 	$this->M_reviews->bintang_lima($items->id_product)->row()->bintang_lima;

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
							$percentage = 5 / $totalreview;

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

						<div class="panel">
							<div class="panel-body">
								<?php if($tokobuka != 1): ?>
									<span class="label label-flat border-warning text-warning-600 pull-right">Toko Sedang Tutup</span>

								<?php endif; ?>
								<br><br>
								<div class="thumb thumb-fixed">

									<?php if(isset($data_user['id_shop']) && ($items->id_shop == $data_user['id_shop'])): ?>

										<a href="<?= base_url("dashboard/products/edit/".$items->id_product) ?>">
											<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
											<span class="zoom-image"><i class="icon-pencil7"></i></span>
										</a>

									<?php else: ?>

										<?php if($tokobuka != 1): ?>

											<a href="<?= base_url($items->sampul_path) ?>" data-popup="lightbox">
												<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
												<span class="zoom-image"></span>
											</a>

										<?php else: ?>

											<a href="<?= base_url("shopping/addtocart/".$items->id_product."/".$whobuy) ?>">
												<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
												<span class="zoom-image"><i class="icon-plus2"></i></span>
											</a>

										<?php endif; ?>

									<?php endif; ?>


								</div>
							</div>

							<div class="panel-body panel-body-accent text-center">
								<h6 class="text-semibold no-margin" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="<?= base_url("product/".$items->id_product) ?>" class="text-default"><?= $items->nama_product ?></a></h6>

								<ul class="list-inline list-inline-separate mb-10">
									<li><a href="#" class="text-muted"><?= $category ?></a></li>
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

					<?php endforeach; ?>

				</div>
			</div>
		</div> <!-- /row -->
	</div>	

	<br><hr><br>

	<div class="container-detached center-div">
		<div class="row">


			<?php 
			$i = 0;
			$harga_reseller = 0;
			$harga_promo = 0;
			$diskon_reseller = 0;
			$diskon_promo = 0;
			$whobuy = "";
			?>

			<?php foreach ($data_product as $items): ?>

				<?php if($i < 8): ?>

					<?php 
					$i++;

					$category = $this->M_category->get($items->id_category)->row()->nama_category;
					$totalreview = $this->M_reviews->select($items->id_product)->nuM_rows();
					$tokobuka = $this->M_shop->selectidshop($items->id_shop)->row()->toko_buka;
					$data_bintang1	= 	$this->M_reviews->bintang_satu($items->id_product)->row()->bintang_satu;
					$data_bintang2 	= 	$this->M_reviews->bintang_dua($items->id_product)->row()->bintang_dua;
					$data_bintang3 	= 	$this->M_reviews->bintang_tiga($items->id_product)->row()->bintang_tiga;
					$data_bintang4 	= 	$this->M_reviews->bintang_empat($items->id_product)->row()->bintang_empat;
					$data_bintang5 	= 	$this->M_reviews->bintang_lima($items->id_product)->row()->bintang_lima;

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
						$percentage = 5 / $totalreview;

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

									<?php if(isset($data_user['id_shop']) && ($items->id_shop == $data_user['id_shop'])): ?>

										<a href="<?= base_url("dashboard/products/edit/".$items->id_product) ?>">
											<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
											<span class="zoom-image"><i class="icon-pencil7"></i></span>
										</a>

									<?php else: ?>

										<?php if($tokobuka != 1): ?>

											<a href="<?= base_url($items->sampul_path) ?>" data-popup="lightbox">
												<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
												<span class="zoom-image"></span>
											</a>

										<?php else: ?>

											<a href="<?= base_url("shopping/addtocart/".$items->id_product."/".$whobuy) ?>">
												<img src="<?= base_url($items->sampul_path) ?>" alt="" style="height: 250px !important;">
												<span class="zoom-image"><i class="icon-plus2"></i></span>
											</a>

										<?php endif; ?>

									<?php endif; ?>


								</div>
							</div>

							<div class="panel-body panel-body-accent text-center">
								<h6 class="text-semibold no-margin" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="<?= base_url("product/".$items->id_product) ?>" class="text-default"><?= $items->nama_product ?></a></h6>

								<ul class="list-inline list-inline-separate mb-10">
									<li><a href="#" class="text-muted"><?= $category ?></a></li>
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


		</div> <!-- /row -->
	</div>

	<br><hr><br>

	<!-- Inside colored panel -->
	<div class="panel panel-flat center-div">
		<div class="panel-heading">
			<h6 class="panel-title text-semibold">Kategori</h6>
		</div>


		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr>
						<td>1</td>
						<td>Eugene</td>
						<td>Kopyov</td>
						<td>@Kopyov</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Victoria</td>
						<td>Baker</td>
						<td>@Vicky</td>
					</tr>
					<tr>
						<td>3</td>
						<td>James</td>
						<td>Alexander</td>
						<td>@Alex</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Franklin</td>
						<td>Morrison</td>
						<td>@Frank</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /inside colored panel -->

	<br><br>


</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
