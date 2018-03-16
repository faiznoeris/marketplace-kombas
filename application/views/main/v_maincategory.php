<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

<!-- 	<div class="row">

		<?php for ($i=0; $i < 2; $i++): ?>

			<div class="col-sm-6">

				<div class="col-sm-12 rounded bg-light" style="padding: 15px 15px 15px 15px;">
					<img src="https://www.elftronix.com/wp-content/uploads/hidemyass-vpn-special-promo-discount.jpg" class="w-100" height="230">
				</div>

			</div>


		<?php endfor; ?>

	</div>

	<br>

	<div class="row">

		<?php for ($i=0; $i < 2; $i++): ?>

			<div class="col-sm-6">

				<div class="col-sm-12 rounded bg-light" style="padding: 15px 15px 15px 15px;">
					<img src="https://www.elftronix.com/wp-content/uploads/hidemyass-vpn-special-promo-discount.jpg" class="w-100" height="230">
				</div>

			</div>

		<?php endfor; ?>

	</div>
-->
<!-- 	<br><br> -->

<div class="row">

	<div class="col-sm-4">

		<ul class="list-group" style="margin-top: 26px;">
			<center><div class="cat-title-line"><h3 class="cat-title">CATEGORIES</h3></div></center>
			<?php
			$i = 0;

			foreach($data_cat as $rows) { 
				if($i < 6){

					if($i == 0){

						echo '				
						<li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
						<a href='. base_url("category/".$rows->id_category) .' class="cat-link">'.$rows->nama_category.'</a>
						</li>';

					}else{

						echo '				
						<li class="list-group-item border-0 d-flex justify-content-between align-items-center">
						<a href='. base_url("category/".$rows->id_category) .' class="cat-link">'.$rows->nama_category.'</a>
						</li>';

					}
				}


				$i++;
			}
			?>
		</ul>

		<br>
	</div>

	<div class="col-sm-8 text-muted" style="margin-top: 16px;">
		<div class="container">	
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
					if($i < 10){

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
						<div class="card">

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

						$tokobuka = $this->m_shop->selectidshop($items->id_shop)->row()->toko_buka;

						echo '
						<p class="card-text">'.$items->nama_product.'</p>
						</div>
						<div class="card-footer bg-white">
						<a href='. base_url("product/".$items->id_product) .' class="btn btn-primary w-100">Lihat Produk</a>';

						if(isset($data_user['id_shop']) && ($items->id_shop == $data_user['id_shop'])){
							echo '<a href='. base_url("dashboard/products/edit/".$items->id_product) .' class="btn btn-primary w-100" style="margin-top: 5px;">Edit Product</a>';
						}else{
							if($tokobuka != 1){
								echo '<a href="" class="btn btn-primary w-100 disabled" style="margin-top: 5px;">Toko Sedang Tutup</a>';	
							}else{
								echo '<a href='. base_url("shopping/addtocart/".$items->id_product."/".$whobuy) .' class="btn btn-primary w-100" style="margin-top: 5px;">Add to Cart</a>';
							}
						}



						echo '
						</div>
						</div>';

					}
				}


				?>

			</div> <!-- row end -->

		</div> <!-- container end -->		
	</div> <!-- col end -->


</div> <!-- /row -->
</div> <!-- /container -->



