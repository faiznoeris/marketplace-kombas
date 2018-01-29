<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

	<?php for ($i=0; $i < 5; $i++): ?>

		<div class="row">

			<div class="col-sm-12 rounded bg-light" style="padding: 10px 10px 10px 10px;">

				<h3>ASDASDASKDMAKSD</h3>

			</div>

		</div>

		<br>

	<?php endfor; ?>

	

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

				</div> <!-- row end -->
				
			</div> <!-- container end -->		
		</div> <!-- col end -->


	</div> <!-- /row -->
</div> <!-- /container -->



