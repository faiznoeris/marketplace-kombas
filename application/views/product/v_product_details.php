<!-- Content area -->
<div class="content">		 
	
	<?php if($found): ?>
		<!-- Detached content -->
		<div class="container-detached">
			<div class="content-detached">

				<!-- Post -->
				<div class="panel">
					<div class="breadcrumb-line bg-primary-300">
						<ul class="breadcrumb">
							<li><a href="<?= base_url(''); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="<?= base_url('shopping/all') ?>">Belanja</a></li>
							<li><a href="<?= base_url('shopping/category/'.$category->nama_category) ?>"><?= $category->nama_category ?></a></li>
							<li class="active"><?= $data_product->nama_product ?></li>
						</ul>
					</div>

					<div class="panel-body">

						<div class="content-group-lg">
							<div class="col-md-5">
								<div class="content-group text-left">
									<div class="product-gallery" style="height: 550px !important;">

										<?php 

										$galeri = explode(',',$data_product->galeri_path);

										?>
										<div class="thumb thumb-fixed">
											<a href="<?= base_url($data_product->sampul_path) ?>" data-popup="lightbox">
												<img src="<?= base_url($data_product->sampul_path) ?>" alt="" style="height: 520px !important;">
												<span class="zoom-image"></span>
											</a>
										</div>
										<?php foreach ($galeri as $path): ?>
											<?php if(!empty($path)): ?>
												<div class="thumb thumb-fixed">
													<a href="<?= base_url($path) ?>" data-popup="lightbox">
														<img src="<?= base_url($path) ?>" alt="" style="height: 520px !important;">
														<span class="zoom-image"></span>
													</a>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>

									</div>
								</div>
							</div>

							<?php 
							$harga_reseller = 0;
							$harga_promo = 0;
							$diskon_reseller = 0;
							$diskon_promo = 0;
							$whobuy = "";

							$category = $this->M_Index->data_productview_getcategory($data_product->id_category)->row()->nama_category;
							$totalreview = $this->M_Index->data_productview_getreview($data_product->id_product)->num_rows();
							$tokobuka = $this->M_Index->data_productview_getshop($data_product->id_shop)->row()->toko_buka;

							if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $data_product->discount_reseller != 0){
								$diskon_reseller = $data_product->harga * $data_product->discount_reseller;
								$diskon_reseller = $diskon_reseller / 100;
								$harga_reseller = $data_product->harga - $diskon_reseller;

								$whobuy = "reseller";
							}else{
								$harga_reseller = $data_product->harga;

								$whobuy = "reguler";
							}

							if($data_product->promo_aktif == '1' && $data_product->discount_promo != 0){
								$diskon_promo = $data_product->harga * $data_product->discount_promo;
								$diskon_promo = $diskon_promo / 100;
								$harga_promo = $data_product->harga - $diskon_promo;	

								$whobuy = "promo";
							}else{
								$harga_promo = $data_product->harga;

								$whobuy = "reguler";
							}


							if($totalreview != 0){
								$percentage = (5*$data_bintang5 + 4*$data_bintang4 + 3*$data_bintang3 + 2*$data_bintang2 + 1*$data_bintang1) / ($data_bintang5 + $data_bintang4 + $data_bintang3 + $data_bintang2 + $data_bintang1);

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

								$bintang_big = '<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}else if($percentage < 2){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';

								$bintang_big = '<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}else if($percentage < 3){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';

								$bintang_big = '<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}else if($percentage < 4){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';

								$bintang_big = '<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}else if($percentage < 5){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';

								$bintang_big = '<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}else if($percentage < 6){
								$bintang = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>';

								$bintang_big = '<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>
								<i class="icon-star-full2 text-size-base text-warning-300" style="font-size: 30px;"></i>';
							}

							?>

							<br class="hidden-lg hidden-xl hidden-md">
							<div class="col-md-7">
								<h3 class="text-semibold mb-5">
									<a href="<?= base_url("product/".$data_product->id_product) ?>" class="text-default"><?= $data_product->nama_product ?></a>
								</h3>

								<ul class="list-inline list-inline-separate text-muted content-group">
									<li><span style="margin-right: 5px;"><?= $percentage ?></span> <?= $bintang ?></li>
									<li><?= $totalreview ?> Ulasan</li>
								<!-- <li><a href="#" class="text-muted">12 comments</a></li>
									<li><a href="#" class="text-muted"><i class="icon-heart6 text-size-base text-pink position-left"></i> 281</a></li> -->
								</ul>

								<div class="content-group">
									<blockquote class="no-margin panel panel-body ">
										
										<?php if($data_product->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5): ?>

											<h3 class="no-margin text-semibold">
												<span class="text-danger text-light" style="font-size: 15px;">Rp.</span> <span class="text-danger"><?= number_format($harga_promo, 0, ',', '.') ?></span>
												<strike style="font-size: 15px;">Rp. <?= number_format($data_product->harga, 0, ',', '.') ?></strike>
											</h3>

										<?php elseif(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5): ?>

											<h3 class="no-margin text-semibold"><span class="text-light" style="font-size: 15px;">Rp.</span> <?= number_format($harga_reseller, 0, ',', '.') ?></h3>

										<?php else: ?>

											<h3 class="no-margin text-semibold"><span class="text-light" style="font-size: 15px;">Rp.</span> <?= number_format($data_product->harga, 0, ',', '.') ?></h3>

										<?php endif; ?>

										<?php if($shop->toko_buka != '1'): ?>
											<br>
											<span class="label label-flat border-warning text-warning-600">Toko Sedang Tutup</span>
										<?php endif; ?>

									</blockquote>
								</div>

								<div class="conten-group">
									<ul class="list list-icons no-margin-bottom">
										<li><i class="icon-pin"></i> Dikirim oleh <b><a href="<?= base_url('u/'.$data_seller->username) ?>"><?= $data_seller->username ?></a></b></li>
										<li><i class="icon-law"></i> Berat <b><?= number_format($data_product->berat, 0, ',', '.') ?> gr</b></li>
									</ul>
								</div>
								<br>
								<div class="conten-group">
									
									<?php if(!empty($data_user['id_user']) && ($shop->toko_buka != '1' || $data_user['id_shop'] != "notseller" || $data_user['user_lvl'] == "1" || $data_user['user_lvl'] == "2")): ?>
										<a class="btn btn-primary btn-xlg disabled" style="margin-right: 10px;"><i class="icon-cart-add position-left"></i> Beli Sekarang</a>
									<?php else: ?>
										<a href="<?= base_url("shopping/addtocart/".$data_product->id_product."/".$whobuy) ?>" class="btn btn-primary btn-xlg" style="margin-right: 10px;"><i class="icon-cart-add position-left"></i> Beli Sekarang</a>
									<?php endif; ?>

									

									<?php if(!empty($data_user['id_shop']) && $shop->id_shop == $data_user['id_shop']): ?>
										<a href="<?= base_url("account/product/edit/".$data_product->id_product) ?>" class="btn btn-primary btn-xlg" style="margin-right: 10px;"><i class="icon-pencil7 position-left"></i> Edit Product</a>
									<?php endif; ?>

									<?php if($loggedin && $user_lvl_name == "Reseller" && $notif == 0): ?>
										<a href="<?= base_url("Shopping/turnsontoknotif/".$data_product->id_product."/".$data_user['id_user']) ?>" class="btn btn-primary btn-xlg" style="margin-right: 10px;"><i class="icon-bell2 position-left"></i> Nyalakan Notifikasi Stok Product</a>
									<?php elseif($loggedin && $user_lvl_name == "Reseller" && $notif == 1): ?>
										<a href="<?= base_url("Shopping/turnsofftoknotif/".$data_product->id_product."/".$data_user['id_user']) ?>" class="btn btn-primary btn-xlg" style="margin-right: 10px;"><i class="icon-bell2 position-left"></i> Matikan Notifikasi Stok Product</a>
									<?php endif; ?>


									<!-- <a href="<?= base_url("shopping/addtocart/".$data_product->id_product."/".$whobuy) ?>" class="btn btn-primary btn-xlg"><i class="icon-cart-add position-left"></i> Beli</a> -->

								</div>

								

							</div>
						</div>
					</div>
				</div>
				<!-- /post -->
				<hr>

				<div class="panel-body">
					<center><h1 class="text-semibold">Related Product</h1></center>

					<div class="row">
						<?php 
						$harga_reseller_rltd = 0;
						$harga_promo_rltd = 0;
						$diskon_reseller_rltd = 0;
						$diskon_promo_rltd = 0;
						$whobuy_rltd = "";
						?>

						<?php foreach ($related_prod as $items): ?>

							<?php 
							$category_rltd = $this->M_Index->data_productview_getcategory($items->id_category)->row()->nama_category;
							$totalreview_rltd = $this->M_Index->data_productview_getreview($items->id_product)->num_rows();
							$tokobuka_rltd = $this->M_Index->data_productview_getshop($items->id_shop)->row()->toko_buka;

							if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $items->discount_reseller != 0){
								$diskon_reseller_rltd = $items->harga * $items->discount_reseller;
								$diskon_reseller_rltd = $diskon_reseller_rltd / 100;
								$harga_reseller_rltd = $items->harga - $diskon_reseller_rltd;

								$whobuy = "reseller";
							}else{
								$harga_reseller_rltd = $items->harga;

								$whobuy = "reguler";
							}

							if($items->promo_aktif == '1' && $items->discount_promo != 0){
								$diskon_promo_rltd = $items->harga * $items->discount_promo;
								$diskon_promo_rltd = $diskon_promo_rltd / 100;
								$harga_promo_rltd = $items->harga - $diskon_promo_rltd;	

								$whobuy = "promo";
							}else{
								$harga_promo_rltd = $items->harga;

								$whobuy = "reguler";
							}


							if($totalreview_rltd != 0){
								$percentage_rltd = 5 / $totalreview_rltd;

								$width_bintang_lima_rltd = $data_bintang5 * 100 / $totalreview_rltd;
								$width_bintang_empat_rltd = $data_bintang4 * 100 / $totalreview_rltd;
								$width_bintang_tiga_rltd = $data_bintang3 * 100 / $totalreview_rltd;
								$width_bintang_dua_rltd = $data_bintang2 * 100 / $totalreview_rltd;
								$width_bintang_satu_rltd = $data_bintang1 * 100 / $totalreview_rltd;

							}else{
								$percentage_rltd = 0;

								$width_bintang_lima_rltd = 0;
								$width_bintang_empat_rltd = 0;
								$width_bintang_tiga_rltd = 0;
								$width_bintang_dua_rltd = 0;
								$width_bintang_satu_rltd = 0;
							}

							if($percentage_rltd < 1){
								$bintang_rltd = '<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage_rltd < 2){
								$bintang_rltd = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage_rltd < 3){
								$bintang_rltd = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage_rltd < 4){
								$bintang_rltd = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage_rltd < 5){
								$bintang_rltd = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-empty3 text-size-base text-warning-300"></i>';
							}else if($percentage_rltd < 6){
								$bintang_rltd = '<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>
								<i class="icon-star-full2 text-size-base text-warning-300"></i>';
							}

							?>
							<div class="col-lg-3 col-sm-6">
								<div class="panel">
									<div class="panel-body">
										<?php if($tokobuka_rltd != 1): ?>
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
											<li><a href="<?= base_url('shopping/category/'.$category) ?>" class="text-muted"><?= $category_rltd ?></a></li>
										</ul>

										<?php if($items->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5): ?>

											<h3 class="no-margin text-semibold">
												Rp. <?= number_format($harga_promo_rltd, 0, ',', '.') ?>
												<strike style="font-size: 15px;">Rp. <?= number_format($items->harga, 0, ',', '.') ?></strike>
											</h3>

										<?php elseif(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5): ?>

											<h3 class="no-margin text-semibold">Rp. <?= number_format($harga_reseller_rltd, 0, ',', '.') ?></h3>

										<?php else: ?>

											<h3 class="no-margin text-semibold">Rp. <?= number_format($items->harga, 0, ',', '.') ?></h3>

										<?php endif; ?>

										<div class="text-nowrap">
											<?= $bintang_rltd ?>
										</div>

										<div class="text-muted"><?= $totalreview_rltd ?> ulasan</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>

				<hr>

				<!-- About author -->
				<div class="panel panel-flat">
					<div class="media panel-body no-margin">
						<div class="media-left">

						</div>

						<div class="media-body">
							<div class="tabbable">
								<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
									<li class="active"><a href="#justified-badges-tab1" data-toggle="tab">Informasi Produk</a></li>
									<li><a href="#justified-badges-tab2" data-toggle="tab">Ulasan Produk <span style="margin-left: 5px;"><?= $bintang ?></span></a></li>

								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="justified-badges-tab1">
										<?= $data_product->deskripsi_product ?>
									</div>

									<div class="tab-pane" id="justified-badges-tab2">
										<blockquote class="no-margin panel panel-body ">
											<div class="col-md-2">
												<h1 class="text-center" style="font-size: 40px;">
													<?= substr($percentage, 0, 3) ?>
												</h1>
												<center><?= $bintang_big ?></center>
												<p class="text-center"><?= $tot_review ?> Ulasan</p>
											</div>

											<div class="col-md-2">
												<div class="content-group" style="margin-bottom: 13px !important;">
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
												</div>

												<div class="content-group" style="margin-bottom: 13px !important;">
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
												</div>

												<div class="content-group" style="margin-bottom: 13px !important;">
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
												</div>

												<div class="content-group" style="margin-bottom: 13px !important;">
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
												</div>

												<div class="content-group">
													<i class="icon-star-full2 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
													<i class="icon-star-empty3 text-size-base text-warning-300"></i>
												</div>

											</div>

											<div class="col-md-3 col-md-pull-1">
												<div class="progress content-group-sm">
													<div class="progress-bar" style="width: <?= $width_bintang_lima.'%' ?>">
													</div>
												</div>
												<div class="progress content-group-sm">
													<div class="progress-bar" style="width: <?= $width_bintang_empat.'%' ?>">
													</div>
												</div>
												<div class="progress content-group-sm">
													<div class="progress-bar" style="width: <?= $width_bintang_tiga.'%' ?>">
													</div>
												</div>
												<div class="progress content-group-sm">
													<div class="progress-bar" style="width: <?= $width_bintang_dua.'%' ?>">
													</div>
												</div>
												<div class="progress content-group-sm">
													<div class="progress-bar" style="width: <?= $width_bintang_satu.'%' ?>">
													</div>
												</div>
											</div>
											
										</blockquote>
										<div class="panel-body">
											<ul class="media-list stack-media-on-mobile">

												<?php if(!empty($results)): ?>

													<?php foreach($results as $row): ?>

														<?php $reviewer_detail = $this->M_Index->data_order_getuser($row->id_user)->row(); ?>


														<li class="media">
															<div class="media-left">
																<a href="#"><img src="<?= base_url($reviewer_detail->ava_path) ?>" class="img-circle img-sm" alt=""></a>
															</div>

															<div class="media-body">
																<div class="media-heading">
																	<a href="<?= base_url('u/'.$reviewer_detail->username) ?>" class="text-semibold"><?= $reviewer_detail->username ?></a>
																	<span class="media-annotation dotted"> <span style="font-size: 12px"><?= $row->date ?></span>
																</div>

																<p><?= $row->ulasan ?></p>

																<!-- <ul class="list-inline list-inline-separate text-size-small">
																	<li>114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
																	<li><a href="#">Reply</a></li>
																	<li><a href="#">Edit</a></li>
																</ul> -->
															</div>
														</li>

													<?php endforeach; ?>

												<?php endif; ?>

												<center><?= $links ?></center>
												
											</ul>

										</div>

										<?php if($loggedin && $data_product->id_shop != $data_user['id_shop']): ?>
											<div class="panel-body">
												<form method="post" action="<?php echo base_url('Review/addreview/'.$data_product->id_product);?>">
													<h6 class="no-margin-top content-group">Beri Ulasan Pada Produk</h6>
													<div class="content-group">

														<div class="row">													
															<div class="col-sm-7">
																<label>Ulasan</label>
																<textarea class="form-control" name="ulasan" rows="6"></textarea>
															</div>

															<div class="col-sm-5" >

																<label>Rating</label>
																<div class="radio">
																	<label>
																		<input type="radio" class="styled" name="bintang"  value="bintang_lima"  />
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																	</label>
																</div>

																<div class="radio">
																	<label>
																		<input type="radio" class="styled" name="bintang"  value="bintang_empat"  />
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																	</label>
																</div>

																<div class="radio">
																	<label>
																		<input type="radio" class="styled" name="bintang"  value="bintang_tiga"  />
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																	</label>
																</div>

																<div class="radio">
																	<label>
																		<input type="radio" class="styled" name="bintang"  value="bintang_dua"  />
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																	</label>
																</div>

																<div class="radio">
																	<label>
																		<input type="radio" class="styled" name="bintang"  value="bintang_satu"  />
																		<i class="icon-star-full2 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																		<i class="icon-star-empty3 text-size-base text-warning-300"></i>
																	</label>
																</div>

															</div> <!-- col -->
														</div>
														<div class="row">
															<div class="col-sm-7">
																<div class="text-right">
																	<br><br>
																	<button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
																</div>
															</div>
														</div>
													</div>


												</form>
											</div>
										<?php endif; ?>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /about author -->

			</div>
		</div>
		<!-- /detached content -->

		<!-- Detached sidebar -->
		<div class="sidebar-detached">
			<div class="sidebar sidebar-default sidebar-separate">
				<div class="sidebar-content">



					<!-- Categories -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Informasi Penjual</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<div class="media-left">
								<img src="<?= base_url($data_seller->ava_path) ?>" class="img-circle img-lg" alt="">
							</div>

							<div class="media-body">
								<span class="text-semibold"><a href="<?= base_url('u/'.$data_seller->username) ?>"><?= $data_seller->username ?></a></span>
								<a href="<?= base_url("account/messages/new/".$data_seller->id_user) ?>" class="media-heading">
									<span class="text-semibold"><i class="icon-mail5 text-left"></i> Kirim Pesan</span>
								</a>
							</div>

							<hr>

							<?php $kurir = explode(',',$shop->kurir); ?>

							<div class="media-body">
								<span class="text-reguler">Pengiriman</span>
								<br><br>

								<?php if((!empty($kurir[0]) && $kurir[0] == 'jne')|| (!empty($kurir[1]) && $kurir[1] == 'jne') || (!empty($kurir[2]) && $kurir[2] == 'jne') || (!empty($kurir[3]) && $kurir[3] == 'jne')): ?>
									<img src="https://www.jakmall.com/images/desktop/icons/logo-jne.png" alt="" height="20" style="margin-right: 5px;">
								<?php endif; ?>


								<?php if((!empty($kurir[0]) && $kurir[0] == 'tiki')|| (!empty($kurir[1]) && $kurir[1] == 'tiki') || (!empty($kurir[2]) && $kurir[2] == 'tiki') || (!empty($kurir[3]) && $kurir[3] == 'tiki')): ?>
									<img src="https://i1.wp.com/www.suryaguna.com/wp-content/uploads/2014/07/logo-expedisi-tiki.jpg" alt="" height="20" style="margin-right: 5px;">
								<?php endif; ?>

								<?php if((!empty($kurir[0]) && $kurir[0] == 'pos')|| (!empty($kurir[1]) && $kurir[1] == 'pos') || (!empty($kurir[2]) && $kurir[2] == 'pos') || (!empty($kurir[3]) && $kurir[3] == 'pos')): ?>
									<img src="https://seeklogo.com/images/P/PT_Pos_Indonesia-logo-1F280B0056-seeklogo.com.png" alt="" height="20" style="margin-right: 5px;">
								<?php endif; ?>




							</div>
						</div>


					</div>
					<!-- /categories -->


					<!-- Share -->
					<!-- <div class="sidebar-category">
						<div class="category-title">
							<span>Share</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding-bottom text-center">
							<ul class="list-inline no-margin">
								<li>
									<a href="#" class="btn bg-indigo btn-icon content-group">
										<i class="icon-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#" class="btn bg-danger btn-icon content-group">
										<i class="icon-youtube3"></i>
									</a>
								</li>
								<li>
									<a href="#" class="btn bg-info btn-icon content-group">
										<i class="icon-twitter"></i>
									</a>
								</li>
								<li>
									<a href="#" class="btn bg-orange btn-icon content-group">
										<i class="icon-feed3"></i>
									</a>
								</li>
							</ul>
						</div>
					</div> -->
					<!-- /share -->
				</div>
			</div>
		</div>
		<!-- /detached sidebar -->

	<?php else: ?>
		<h3>Product tidak ditemukan..</h3>
	<?php endif; ?>

</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
