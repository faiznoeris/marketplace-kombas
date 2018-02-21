<div class="container">

	<!-- <div class="row"> -->
		<nav class="breadcrumb">
			<a class="breadcrumb-item" href="<?= base_url(''); ?>">Home</a>
			<a class="breadcrumb-item" href="<?= base_url('category/'.$category->id_category) ?>"><?= $category->nama_category ?></a>
			<span class="breadcrumb-item active"><?= $data_product->nama_product ?></span>
		</nav>
		<h3 style="margin-left: 15px;"><?= $data_product->nama_product ?></h3>
		<!-- </div> -->
		<hr class="featurette-divider" style="margin-top: 40px; margin-bottom: 45px;">
		<div class="row">

			<div class="col-sm-4">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

					<?php 

					$galeri = explode(',',$data_product->galeri_path);

					?>

					<ol class="carousel-indicators">

						<?php 
						$count = 0;
						$first = true;
						foreach ($galeri as $path) {

							if($first){

								echo '
								<li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'" class="active"></li>
								';

								$first = false;
							}else if(!empty($path)){
								echo '
								<li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'"></li>
								';
							}

							$count++;

						}
						?>



					</ol>

					<div class="carousel-inner product" role="listbox">

						<?php

						$first = true;

						foreach ($galeri as $path) {

							if($first == true){

								echo '
								<div class="carousel-item active">
								<div class="tile first-slide d-block img-responsive" data-scale="2.4" data-image="'.base_url($path).'"></div>
								</div>
								';

								$first = false;
							}else if(!empty($path)){

								echo '

								<div class="carousel-item">
								<div class="tile first-slide d-block img-responsive" data-scale="2.4" data-image="'.base_url($path).'"></div>
								</div>

								';
							}

						}

						?>

					</div>

					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

			</div>

			<div class="col-sm-5">
				<table class="table table-responsive">
					<tbody>
						<tr>
							<td style="font-weight: 500"><span class="oi oi-briefcase"></span> Berat</td>
							<td></span> <?= $data_product->berat ?> gr</td>
							<td style="font-weight: 500"><span class="oi oi-eye"></span> Dilihat</td>
							<td></span> <?= $data_product->views ?> kali</td>
						</tr>
<!-- 						<tr>
							<td><span class="oi oi-headphones"></span> Kondisi</td>
							<td></span> Baru</td>
							<td><span class="oi oi-eye"></span> Dilihat</td>
							<td></span> 7</td>
						</tr>
						<tr>
							<td><span class="oi oi-headphones"></span> Kondisi</td>
							<td></span> Baru</td>
							<td><span class="oi oi-eye"></span> Dilihat</td>
							<td></span> 7</td>
						</tr>
						<tr>
							<td><span class="oi oi-headphones"></span> Kondisi</td>
							<td></span> Baru</td>
							<td><span class="oi oi-eye"></span> Dilihat</td>
							<td></span> 7</td>
						</tr> -->

					</tbody>
				</table>

				<br>
				<h5>Informasi Produk</h5>
				<!-- <img data-src="holder.js/100px280/thumb" alt="Card image cap"> -->
				<p><?= $data_product->deskripsi_product ?></p>
			</div>


			<?php 

			$harga_reseller = 0;
			$harga_promo = 0;
			$diskon_reseller = 0;
			$diskon_promo = 0;
			$whobuy = "";

			if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $data_product->discount_reseller != 0){
				$diskon_reseller = $data_product->harga * $data_product->discount_reseller;
				$diskon_reseller = $diskon_reseller / 100;
				$harga_reseller = $data_product->harga - $diskon_reseller;
			}else{
				$harga_reseller = $data_product->harga;
			}

			if($data_product->promo_aktif == '1' && $data_product->discount_promo != 0){
				$diskon_promo = $data_product->harga * $data_product->discount_promo;
				$diskon_promo = $diskon_promo / 100;
				$harga_promo = $data_product->harga - $diskon_promo;	
			}else{
				$harga_promo = $data_product->harga;
			}

			?>

			<div class="col-sm-3">

				<?php 

				if($data_product->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5){


					echo '
					<h5 class="text-center" style="font-weight: 400; font-size: 20px;"><strike>Rp. '.number_format($data_product->harga, 0, ',', '.').'</strike></h5>
					<h5 class="text-center" style="font-weight: 500; font-size: 25px;">Rp. '.number_format($harga_promo, 0, ',', '.').'</h5>
					<center><i style="font-size: 20px;">('.$data_product->discount_promo.'% OFF)</i></center><br>
					';

					$whobuy = "promo";

				}else if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5){

					echo '
					<h5 class="text-center" style="font-weight: 500; font-size: 25px;">Rp. '.number_format($harga_reseller, 0, ',', '.').'</h5><br>
					';

					$whobuy = "reseller";

				}else{
					echo '
					<h5 class="text-center" style="font-weight: 500; font-size: 25px;">Rp. '.number_format($data_product->harga, 0, ',', '.').'</h5><br>
					';

					$whobuy = "reguler";

				}

				?>

				<!-- data-toggle="modal" data-target="#exampleModal" -->
				<?php if(isset($data_user['id_shop']) && ($data_product->id_shop == $data_user['id_shop'])): ?>
					<a class="btn btn-primary btn-block" href="<?= base_url("dashboard/products/edit/".$data_product->id_product) ?>"> Edit Product</a><br><br>
				<?php else: ?>
					<a class="btn btn-primary btn-block" href="<?= base_url("shopping/addtocart/".$data_product->id_product."/".$whobuy) ?>"><span class="oi oi-cart"></span> Beli</a><br><br>
				<?php endif; ?>
				

				<hr class="featurette-divider" style="margin-top: -10px; margin-bottom: 25px;">
				<center><h3>Penjual</h3></center><br>
				<center><img class="rounded" src="<?= base_url($data_seller->ava_path) ?>"  width="150" height="100"></center><br>
				<!-- <center><h5 style="font-size: 15px; font-weight: 500">75% total transaksi berhasil</h5></center> -->
				<center><h5><?= $data_seller->username ?></h5></center>
				<center><a class="btn btn-primary btn-block w-50" href="<?= base_url("dashboard/messages/".$data_seller->id_user) ?>">Message</a></center><br><br>

				<hr class="featurette-divider" style="margin-top: -10px; margin-bottom: 25px;">
				<center><h3>Related Products</h3></center><br>

				<?php 
				$first = true; 
				$i = 0;
				$harga_reseller = 0;
				$harga_promo = 0;
				$diskon_reseller = 0;
				$diskon_promo = 0;
				$whobuy = "";
				?>

				<?php foreach($related_prod as $row): ?>

					<?php 

					if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $row->discount_reseller != 0){
						$diskon_reseller = $row->harga * $row->discount_reseller;
						$diskon_reseller = $diskon_reseller / 100;
						$harga_reseller = $row->harga - $diskon_reseller;
					}else{
						$harga_reseller = $row->harga;
					}

					if($row->promo_aktif == '1' && $row->discount_promo != 0){
						$diskon_promo = $row->harga * $row->discount_promo;
						$diskon_promo = $diskon_promo / 100;
						$harga_promo = $row->harga - $diskon_promo;	
					}else{
						$harga_promo = $row->harga;
					}



					if($i == 2){
						break;
					}

					if ($row->nama_product == $data_product->nama_product) {
						continue;
						$i++;
					}

					?>

					<?php if($first): ?>
						<center>
							<img src="<?= base_url($row->sampul_path) ?>">
							<span><?= $row->nama_product ?></span><br>

							<?php if($row->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5): ?>
								<span style="font-weight: 400; font-size: 15px;"><strike>Rp. <?= number_format($row->harga, 0, ',', '.') ?></strike></span><br>
								<span style="font-weight: 500; font-size: 20px;">Rp. <?= number_format($harga_promo, 0, ',', '.') ?></span><br><br>
							<?php elseif(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5): ?>
								<span>Rp. <?= number_format($harga_reseller, 0, ',', '.') ?></span><br><br>
							<?php else: ?>
								<span>Rp. <?= number_format($row->harga, 0, ',', '.') ?></span><br><br>
							<?php endif; ?>

							
							<a class="btn btn-primary btn-small btn-block w-50" href="<?= base_url("product/".$row->id_product) ?>">View</a>
						</center><br><br>
						<?php $first = false; ?>
					<?php else: ?>
						<center>
							<img src="<?= base_url($row->sampul_path) ?>"><br>
							<span><?= $row->nama_product ?></span><br>

							<?php if($row->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5): ?>
								<span style="font-weight: 400; font-size: 15px;"><strike>Rp. <?= number_format($row->harga, 0, ',', '.') ?></strike></span><br>
								<span style="font-weight: 500; font-size: 20px;">Rp. <?= number_format($harga_promo, 0, ',', '.') ?></span><br><br>
							<?php elseif(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5): ?>
								<span>Rp. <?= number_format($harga_reseller, 0, ',', '.') ?></span><br><br>
							<?php else: ?>
								<span>Rp. <?= number_format($row->harga, 0, ',', '.') ?></span><br><br>
							<?php endif; ?>

							<a class="btn btn-primary btn-small btn-block w-50" href="<?= base_url("product/".$row->id_product) ?>">View</a>
						</center>
					<?php endif; ?>
					<?php $i++; ?>
					
				<?php endforeach; ?>

			</div>




		</div>

		<hr class="featurette-divider">

		<div class="row"><div class="col-sm-12"><h5>Ringkasan Ulasan</h5></div></div>

		<br>

		<div class="row">




			<div class="col-sm-4">

				<?php 

				if($tot_review != 0){
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




				if($percentage < 2){
					$bintang = '<span class="oi oi-star"></span>';
				}else if($percentage < 3){
					$bintang = '<span class="oi oi-star"></span><span class="oi oi-star"></span>';
				}else if($percentage < 4){
					$bintang = '<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span>';
				}else if($percentage < 5){
					$bintang = '<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span>';
				}else if($percentage < 6){
					$bintang = '<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span>';
				}

				?>

				<h1 class="text-center"><?= substr($percentage, 0, 3) ?> / 5</h1>
				<center><?= $bintang ?></center>

				<p class="text-center"><?= $tot_review ?> Ulasan</p>
			</div>	

			<div class="col-sm-3">
				<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><br>
				<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><br>
				<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><br>
				<span class="oi oi-star"></span><span class="oi oi-star"></span><br>
				<span class="oi oi-star"></span><br>
			</div>

			<div class="col-sm-5">
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?= $width_bintang_lima.'%' ?>" aria-valuenow="<?= $data_bintang5 ?>" aria-valuemin="0" aria-valuemax="<?= $tot_review ?>"></div>
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?= $width_bintang_empat.'%' ?>" aria-valuenow="<?= $data_bintang4 ?>" aria-valuemin="0" aria-valuemax="<?= $tot_review ?>"></div>
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?= $width_bintang_tiga.'%' ?>" aria-valuenow="<?= $data_bintang3 ?>" aria-valuemin="0" aria-valuemax="<?= $tot_review ?>"></div>
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?= $width_bintang_dua.'%' ?>" aria-valuenow="<?= $data_bintang2 ?>" aria-valuemin="0" aria-valuemax="<?= $tot_review ?>"></div>
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: <?= $width_bintang_satu.'%' ?>" aria-valuenow="<?= $data_bintang1 ?>" aria-valuemin="0" aria-valuemax="<?= $tot_review ?>"></div>
				</div>
			</div>

		</div>
		<br>

		<div class="row">
			<div class="col-sm-12">

				<?php if(!empty($results)): ?>

					<?php foreach($results as $row): ?>

						<?php $reviewer_detail = $this->m_users->select($row->id_user)->row(); ?>

						<div class="media">
							<img class="d-flex mr-3" src="<?= base_url($reviewer_detail->ava_path) ?>" height="64" width="64" alt="Generic placeholder image">
							<div class="media-body">
								<h5 class="mt-0"><?= $reviewer_detail->username ?> &nbsp; <span style="font-size: 12px"><?= $row->date ?></span></h5> 
								<?= $row->ulasan ?>
							</div>
						</div><br>

					<?php endforeach; ?>

				<?php endif; ?>

				<center><?= $links ?></center>


				<br>

				<?php if($loggedin): ?>

					<legend>Beri Ulasan Pada Produk</legend>
					<form method="post" action="<?php echo base_url('Review/addreview/'.$data_product->id_product);?>">

						<div class="row">

							<div class="col-sm-7">

								<div class="form-group">
									<label for="exampleTextarea">Ulasan</label>
									<textarea class="form-control" name="ulasan" rows="6"></textarea>
								</div>
							</div>

							<div class="col-sm-5" >
								
								<legend style="font-size: 17px;">Rating</legend>
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="bintang"  value="bintang_lima"  />
										<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span>
									</label>
								</div>

								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="bintang"  value="bintang_empat"  />
										<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span>
									</label>
								</div>

								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="bintang"  value="bintang_tiga"  />
										<span class="oi oi-star"></span><span class="oi oi-star"></span><span class="oi oi-star"></span></span>
									</label>
								</div>

								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="bintang"  value="bintang_dua"  />
										<span class="oi oi-star"></span><span class="oi oi-star"></span></span>
									</label>
								</div>

								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="bintang"  value="bintang_satu"  />
										<span class="oi oi-star"></span></span>
									</label>
								</div>

							</div> <!-- col -->


						</div> <!-- row -->

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				<?php endif; ?>

			</div>




			

		</div>

		<br><br>


	</div> <!-- /container -->
