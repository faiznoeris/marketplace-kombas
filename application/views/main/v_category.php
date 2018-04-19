<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">

		<div class="col-sm-4">

			<ul class="list-group" style="margin-top: 26px;">
				<center><div class="cat-title-line"><h3 class="cat-title">CATEGORIES</h3></div></center>
				<?php
				$i = 0;

				foreach($data_cat as $rows) { 
					if($i < 6){

						if($i == 0){

							if($rows->id_category == $this->uri->segment(2)){
								echo '				
								<li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
								<a href='. base_url("category/".$rows->id_category) .' class="cat-link text-primary" style="font-weight: 700">'.$rows->nama_category.'</a>
								</li>';
							}else{
								echo '				
								<li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
								<a href='. base_url("category/".$rows->id_category) .' class="cat-link">'.$rows->nama_category.'</a>
								</li>';
							}


							// echo '				
							// <li class="list-group-item border-0 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
							// <a href='. base_url("category/".$rows->id_category) .' class="cat-link">'.$rows->nama_category.'</a>
							// </li>';

						}else{

							if($rows->id_category == $this->uri->segment(2)){
								echo '				
								<li class="list-group-item border-0 d-flex justify-content-between align-items-center">
								<a href='. base_url("category/".$rows->id_category) .' class="cat-link text-primary" style="font-weight: 700">'.$rows->nama_category.'</a>
								</li>';
							}else{
								echo '				
								<li class="list-group-item border-0 d-flex justify-content-between align-items-center">
								<a href='. base_url("category/".$rows->id_category) .' class="cat-link">'.$rows->nama_category.'</a>
								</li>';
							}



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

				</div> <!-- row end -->
				<center><?=  $links ?></center>
			</div> <!-- container end -->		
		</div> <!-- col end -->


	</div> <!-- /row -->
</div> <!-- /container -->



