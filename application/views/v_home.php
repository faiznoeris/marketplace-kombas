<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="first-slide" src="https://www.firstvehicleleasing.co.uk/blog/wp-content/uploads/2014/05/The_all-new_Volvo_XC90_Volvo_55202.jpg" alt="First slide">
			<div class="container">
				<div class="carousel-caption d-none d-md-block text-left">
					<h1>Example headline.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<img class="second-slide" src="http://image.trucktrend.com/f/75226439+re0+ar0+st0/2016-volvo-xc90-r-design-front-side-view-2.jpg" alt="Second slide">
			<div class="container">
				<div class="carousel-caption d-none d-md-block">
					<h1>Another example headline.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<img class="third-slide" src="http://st.motortrend.com/uploads/sites/10/2016/11/2017-Ford-Fiesta-front-three-quarter-01.jpg" alt="Third slide">
			<div class="container">
				<div class="carousel-caption d-none d-md-block text-right">
					<h1>One more for good measure.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
				</div>
			</div>
		</div>
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

<div class="container">

	<div class="row">

		<div class="col-sm-4">
			<ul class="list-group" style="margin-top: 26px;">
				<center><div class="cat-title-line"><h3 class="cat-title">CATEGORIES</h3></div></center>


				<?php
				$i = 0;

				for ($i=0; $i < 6; $i++) { 
					if($i < 6){

						if($i == 0){

							echo '				
							<li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
							<a href='. base_url("category") .' class="cat-link">Cras justo odio</a>
							</li>';

						}else{

							echo '				
							<li class="list-group-item border-0 d-flex justify-content-between align-items-center">
							<a href='. base_url("category") .' class="cat-link">Cras justo odio</a>
							</li>';

						}
					}
				}
				?>

			</ul>

			<br>

			<ul class="list-group" style="margin-top: 26px;">
				<center><div class="cat-title-line"><h3 class="cat-title">BRANDS</h3></div></center>

				<?php
				$i = 0;

				for ($i=0; $i < 6; $i++) { 
					if($i < 6){

						if($i == 0){

							echo '				
							<li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
							<a href='. base_url("category") .' class="cat-link">Cras justo odio</a>
							<span class="cat-link" style="float: right;">(25)</span>
							</li>';

						}else{

							echo '				
							<li class="list-group-item border-0 d-flex justify-content-between align-items-center">
							<a href='. base_url("category") .' class="cat-link">Cras justo odio</a>
							<span class="cat-link" style="float: right;">(25)</span>
							</li>';

						}
					}
				}
				?>

			</ul>

		</div>

		<div class="col-sm-8 album text-muted">
			<div class="container">
				<center><h3>Features Items</h3></center>
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
							<a href='. base_url("shopping/addtocart") .' class="btn btn-primary w-100" style="margin-top: 5px;">Add to Cart</a>
							</div>

							</div>';

						}
					}
					?>




				</div>
				<hr class="featurette-divider">
				<center><h3>Recommended Items</h3></center>
				<div id="carouselExampleIndicators" class="row carousel slide" data-ride="carousel" style="margin-left: 50px; margin-right: 50px;">


					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<!-- <img class="d-block h-100 w-100" src="#" data-src="holder.js/900x400?theme=social" alt="First slide"> -->
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
						<div class="carousel-item">
							<!-- <img class="d-block h-100 w-100" src="#" data-src="holder.js/900x400?theme=industrial" alt="Second slide"> -->
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
				</div>
			</div>

		</div>
	</div>	



</div> <!-- /container -->

