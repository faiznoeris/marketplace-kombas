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
			<form method="get" action="<?php echo base_url('search');?>" class="main-search">
				<div class="input-group content-group">
					<div class="has-feedback has-feedback-left">
						<?php if(!empty(urldecode($_GET['search']))): ?>
							<input type="text" class="form-control input-xlg" value="<?= urldecode($_GET['search']) ?>" name="search">
						<?php else: ?>
							<input type="text" class="form-control input-xlg" placeholder="Cari barang.." name="search">
						<?php endif; ?>
						
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
									<i class="icon-stack2 position-left"></i> Categories <span class="caret"></span>
								</a>



								<ul class="dropdown-menu">
									<?php foreach($data_cat as $row): ?>
										<?php if($row->id_category == $this->uri->segment(3)): ?>
											<li class="radio active">
												<label><input type="radio" class="styled" name="category" value="<?= $row->id_category ?>"> <?= $row->nama_category ?></label>
											</li>
										<?php else: ?>
											<li class="radio">
												<label><input type="radio" class="styled" name="category" value="<?= $row->id_category ?>"> <?= $row->nama_category ?></label>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown">
									<i class="icon-stack2 position-left"></i> Rating <span class="caret"></span>
								</a>



								<ul class="dropdown-menu">

									<li class="checkbox">
										<label class="display-block">
											<input type="checkbox" class="styled" name="rating[]" value="5">
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
										</label>
									</li>

									<li class="checkbox">
										<label class="display-block">
											<input type="checkbox" class="styled" name="rating[]" value="4">
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
										</label>
									</li>	

									<li class="checkbox">
										<label class="display-block">
											<input type="checkbox" class="styled" name="rating[]" value="3">
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
										</label>
									</li>

									<li class="checkbox">
										<label class="display-block">
											<input type="checkbox" class="styled" name="rating[]" value="2">
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
										</label>
									</li>

									<li class="checkbox">
										<label class="display-block">
											<input type="checkbox" class="styled" name="rating[]" value="1">
											<i class="icon-star-full2 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
											<i class="icon-star-empty3 text-size-base text-warning-300"></i>
										</label>
									</li>

								</ul>
							</li>
						</ul>
					</div>

					<!-- <div class="col-sm-6 text-right">
						<ul class="list-inline no-margin-bottom">
							<li><a href="#" class="btn btn-link btn-sm"><i class="icon-make-group position-left"></i> Browse website</a></li>
							<li><a href="#" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i> Advanced search</a></li>
						</ul>
					</div> -->
				</div>
			</form>
		</div>
	</div>
	<!-- /Search fields -->

	<!-- Search results -->
	<div class="content-group">
		<p class="text-muted text-size-small content-group">About <?= $totalfound ?> results ({elapsed_time} seconds)</p>

		<div class="search-results-list">
			<div class="row">
				<?php 
				$harga_reseller = 0;
				$harga_promo = 0;
				$diskon_reseller = 0;
				$diskon_promo = 0;
				$whobuy = "";
				?>

				<?php if($totalfound != 0): ?>
					<?php foreach ($results as $items): ?>
						<?php if($items->bintang != NULL): ?>

							<?php 
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
							}else{
								$bintang = $percentage;
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
											<li><a href="<?= base_url('shopping/category/'.$items->id_category) ?>" class="text-muted"><?= $category ?></a></li>
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
				<?php else: ?>
					<h3>Data tidak ditemukan..</h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- /Search result -->

	<!-- Pagination -->
	<div class="text-center content-group">
		<?= $links ?>
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
