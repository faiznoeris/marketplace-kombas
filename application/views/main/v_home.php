<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">

		<?php $first = true; $count = 0; ?>
		<?php foreach($data_header as $row): ?>

			<?php if($first): ?>

				<li data-target="#myCarousel" data-slide-to="<?= $count ?>" class="active"></li>

			<?php else: ?>

				<li data-target="#myCarousel" data-slide-to="<?= $count ?>"></li>

			<?php endif; ?>

			<?php $first = false; ?>

			<?php $count++ ?>

		<?php endforeach; ?>

	</ol>
	<div class="carousel-inner">

		<?php $first = true; ?>
		<?php foreach($data_header as $row): ?>

			<?php if($first): ?>

				<div class="carousel-item active">
					<img class="first-slide" src="<?= base_url($row->header_path) ?>">
				</div>

			<?php else: ?>

				<div class="carousel-item">
					<img class="first-slide" src="<?= base_url($row->header_path) ?>">
				</div>

			<?php endif; ?>

			<?php $first = false; ?>

		<?php endforeach; ?>

	</div>
	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="container" style="margin-top: -80px;">

	<div class="row">


		<div class="col-sm-12 album text-muted">
			<div class="container">
				<center><h3>Features Items</h3></center>
				<div class="row">	

					<?php
					$i = 0;
					$harga_reseller = 0;
					$harga_promo = 0;
					$diskon_reseller = 0;
					$diskon_promo = 0;
					$whobuy = "";

					foreach ($data_product as $items) {
						$i++;
						if($i < 6){

							if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5 && $items->discount_reseller != 0){
								$diskon_reseller = $items->harga * $items->discount_reseller;
								$diskon_reseller = $diskon_reseller / 100;
								$harga_reseller = $items->harga - $diskon_reseller;
							}else{
								$harga_reseller = $items->harga;
							}

							if($items->promo_aktif == '1' && $items->discount_promo != 0){
								$diskon_promo = $items->harga * $items->discount_promo;
								$diskon_promo = $diskon_promo / 100;
								$harga_promo = $items->harga - $diskon_promo;	
							}else{
								$harga_promo = $items->harga;
							}

							echo '					
							<div class="col-sm-3">
							<div class="card-b">

							<img class="card-img-top" src="'.base_url($items->sampul_path).'" alt="Card image cap" height="250">

							<div class="card-body">
							';


							if($items->promo_aktif == '1' && !empty($data_user["user_lvl"]) && $data_user["user_lvl"] != 5){
								echo '
								<center>
								<span style="font-weight: 400; font-size: 20px;"><strike>Rp. '.number_format($items->harga, 0, ',', '.').'</strike></span>
								</center>
								<center>
								<span style="font-weight: 500; font-size: 25px;">Rp. '.number_format($harga_promo, 0, ',', '.').' <br><i style="font-size: 20px;">('.$items->discount_promo.'% OFF)</i></span>
								</center>
								<br>
								';

								$whobuy = "promo";
							}else if(!empty($data_user["user_lvl"]) && $data_user["user_lvl"] == 5){

								echo '
								<center>
								<span style="font-weight: 500; font-size: 25px;">Rp. '.number_format($harga_reseller, 0, ',', '.').'</span>
								</center>
								<br><br><br><br>
								';

								$whobuy = "reseller";
							}else{
								echo '
								<center>
								<span style="font-weight: 500; font-size: 25px;">Rp. '.number_format($items->harga, 0, ',', '.').'</span>
								</center>
								<br><br><br><br>
								';

								$whobuy = "reguler";
							}


							echo '
							<p class="card-b-text">'.$items->nama_product.'</p>
							</div>
							<div class="card-footer bg-white">
							<a href='. base_url("product/".$items->id_product) .' class="btn btn-primary w-100">Lihat Produk</a>';

							if(isset($data_user['id_shop']) && ($items->id_shop == $data_user['id_shop'])){
								echo '<a href='. base_url("dashboard/products/edit/".$items->id_product) .' class="btn btn-primary w-100" style="margin-top: 5px;">Edit Product</a>';
							}else{
								echo '<a href='. base_url("shopping/addtocart/".$items->id_product."/".$whobuy) .' class="btn btn-primary w-100" style="margin-top: 5px;">Add to Cart</a>';
							}
							

							
							echo '
							</div>
							</div>
							</div>';

						}
					}


					?>




				</div>



				<!-- <hr class="featurette-divider"> -->
<!-- 				<center><h3>Recommended Items</h3></center>
				<div id="carouselExampleIndicators" class="row carousel slide" data-ride="carousel" style="margin-left: 50px; margin-right: 50px;">


					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<!-- <img class="d-block h-100 w-100" src="#" data-src="holder.js/900x400?theme=social" alt="First slide"> -->
							<!-- <div class="row">

								<?php
								$i = 0;

								for ($i=0; $i < 6; $i++) { 
									if($i < 6){
										echo '					

										<div class="card">

										<img class="card-img-top" src="http://image.elevenia.co.id/g/8/0/5/4/3/7/18805437_B_V1.jpg" alt="Card image cap">

										<div class="card-body">
										<center><p style="font-weight: 500; font-size: 25px;">Rp. 500.000</p></center>
										<p class="card-text">Salvo Sepatu Pria Slip On Shoes A-01 / Size 39-43.</p>
										</div>
										<div class="card-footer bg-white">
										<a href='. base_url("product") .' class="btn btn-primary w-100">Lihat Produk</a>
										<a href="#" class="btn btn-primary w-100" style="margin-top: 5px;">Add to Cart</a>
										</div>

										</div>';

									}
								}
								?>


							</div>

						</div>
						<div class="carousel-item">
							<img class="d-block h-100 w-100" src="#" data-src="holder.js/900x400?theme=industrial" alt="Second slide">
							<div class="row">

								<?php
								$i = 0;

								for ($i=0; $i < 6; $i++) { 
									if($i < 6){
										echo '					

										<div class="card">

										<img class="card-img-top" src="http://image.elevenia.co.id/g/8/0/5/4/3/7/18805437_B_V1.jpg" alt="Card image cap">

										<div class="card-body">
										<center><p style="font-weight: 500; font-size: 25px;">Rp. 500.000</p></center>
										<p class="card-text">Salvo Sepatu Pria Slip On Shoes A-01 / Size 39-43.</p>
										</div>
										<div class="card-footer bg-white">
										<a href='. base_url("product") .' class="btn btn-primary w-100">Lihat Produk</a>
										<a href="#" class="btn btn-primary w-100" style="margin-top: 5px;">Add to Cart</a>
										</div>

										</div>';

									}
								}
								?>

							</div>
						</div>
					</div>


					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="width: 5%; margin-left: -35px;">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="width: 5%; margin-right: -35px;">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div> -->
			</div>  

		</div>
	</div>	



</div> <!-- /container -->

