<!-- Content area -->
<div class="content">		 
	<!-- Search fields -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Website search results</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<form action="#" class="main-search">
				<div class="input-group content-group">
					<div class="has-feedback has-feedback-left">
						<input type="text" class="form-control input-xlg" value="Limitless interface kit">
						<div class="form-control-feedback">
							<i class="icon-search4 text-muted text-size-base"></i>
						</div>
					</div>

					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-xlg">Search</button>
					</div>
				</div>

				<div class="row search-option-buttons">
					<div class="col-sm-6">
						<ul class="list-inline list-inline-condensed no-margin-bottom">
							<li class="dropdown">
								<a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown">
									<i class="icon-stack2 position-left"></i> All categories <span class="caret"></span>
								</a>

								<ul class="dropdown-menu">
									<li><a href="#"><i class="icon-question7"></i> Getting started</a></li>
									<li><a href="#"><i class="icon-accessibility"></i> Registration</a></li>
									<li><a href="#"><i class="icon-reading"></i> General info</a></li>
									<li><a href="#"><i class="icon-gear"></i> Your settings</a></li>
									<li><a href="#"><i class="icon-graduation"></i> Copyrights</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="icon-mail-read"></i> Contacting authors</a></li>
								</ul>
							</li>
							<li><a href="#" class="btn btn-link btn-sm"><i class="icon-reload-alt position-left"></i> Refine your search</a></li>
						</ul>
					</div>

					<div class="col-sm-6 text-right">
						<ul class="list-inline no-margin-bottom">
							<li><a href="#" class="btn btn-link btn-sm"><i class="icon-make-group position-left"></i> Browse website</a></li>
							<li><a href="#" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i> Advanced search</a></li>
						</ul>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /Search fields -->

	<!-- Search results -->
	<div class="content-group">
		<p class="text-muted text-size-small content-group">About <?= $totalfound ?> results (0.34 seconds)</p>

		<div class="search-results-list">
			<div class="row">
				<?php 
				$harga_reseller = 0;
				$harga_promo = 0;
				$diskon_reseller = 0;
				$diskon_promo = 0;
				$whobuy = "";
				?>

				<?php foreach ($data_search as $items): ?>

					<?php 
					$category = $this->m_category->get($items->id_category)->row()->nama_category;
					$totalreview = $this->m_reviews->select($items->id_product)->num_rows();
					$tokobuka = $this->m_shop->selectidshop($items->id_shop)->row()->toko_buka;

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
						$percentage = 5 / $tot_review;

						$width_bintang_lima = $data_bintang5 * 100 / $tot_review;
						$width_bintang_empat = $data_bintang4 * 100 / $tot_review;
						$width_bintang_tiga = $data_bintang3 * 100 / $tot_review;
						$width_bintang_dua = $data_bintang2 * 100 / $tot_review;
						$width_bintang_satu = $data_bintang1 * 100 / $tot_review;

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
								<h6 class="text-semibold no-margin" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="#" class="text-default"><?= $items->nama_product ?></a></h6>

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
					

				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<!-- /Search result -->

	<!-- Pagination -->
	<div class="text-center content-group">
		<ul class="pagination">
			<li class="disabled"><a href="#">&larr;</a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><span>...</span></li>
			<li><a href="#">58</a></li>
			<li><a href="#">59</a></li>
			<li><a href="#">&rarr;</a></li>
		</ul>
	</div>
	<!-- /pagination -->
</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
