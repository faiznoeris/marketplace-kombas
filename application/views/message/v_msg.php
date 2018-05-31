<!-- Content area -->
<div class="content">	

	<div class="row">
		<div class="col-lg-2">
			<!-- Secondary sidebar -->
			<div class=" sidebar-secondary sidebar-default" style="-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);">
				<div class="sidebar-content">



					<!-- Actions -->
<!-- 					<div class="sidebar-category">
						<div class="category-title">
							<span>Actions</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<a href="#" class="btn bg-pink-400 btn-rounded btn-block btn-xs">New message</a>
						</div>
					</div>
				-->					<!-- /actions -->









				<!-- Latest messages -->
				<div class="sidebar-category">
					<div class="category-title">
						<span>Latest connections</span>
						
					</div>

					<div class="category-content no-padding">
						<ul class="media-list media-list-linked">
							<?php $counter = 1; ?>
							<?php foreach($data_msg as $row): ?>

								<?php if($counter <= 5): ?>

									<?php 
									if($row->id_user == $data_user["id_user"]){
										$connection_detail = $this->M_Index->data_order_getuser($row->id_receiver)->row();
									}else{
										$connection_detail = $this->M_Index->data_order_getuser($row->id_user)->row();
									}
									$counter++;
									?>

									<li class="media">
										<a href="<?= base_url('account/messages/convo/'.$row->id_convo) ?>" class="media-link">
											<div class="media-left"><img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt=""></div>
											<div class="media-body">
												<span class="media-heading text-semibold"><?= $connection_detail->username ?></span>
												<span class="text-muted" style="white-space: nowrap; text-overflow: ellipsis; width: 200px; display: block; overflow: hidden"><?= $row->msg ?></span>
											</div>
										</a>
									</li>

								<?php endif; ?>

							<?php endforeach; ?>

							

							
						</ul>
					</div>
				</div>
				<!-- /latest messages -->

			</div>
		</div>
		<!-- /secondary sidebar -->
	</div>
	<div class="col-lg-7">

		<!-- Left annotation position -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">All Messages</h6>

			</div>

			<div class="panel-body">
				<ul class="media-list chat-list content-group dropdown-content-body">
					<?php foreach($data_msg as $row): ?>

						<?php 
						if($row->id_user == $data_user["id_user"]){
							$connection_detail = $this->M_Index->data_order_getuser($row->id_receiver)->row();
						}else{
							$connection_detail = $this->M_Index->data_order_getuser($row->id_user)->row();
						}
						$count_msg = $this->M_Index->data_navbarmsg_countmsg($row->id_convo,$data_user['id_user'])->num_rows();
						?>

						<li class="media">
							
							<div class="media-left">
								<img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt="">
								<span class="badge bg-danger-400 media-badge">
									<?php if($count_msg > 0): ?>
										<?= $count_msg ?>
									<?php endif; ?>
								</span>
							</div>
							<div class="media-body">

								<div class="media-heading">
									<a href="<?= base_url('u/'.$connection_detail->username) ?>" class="text-semibold"><span><?= $connection_detail->username ?></span></a>

									<?php 
									date_default_timezone_set('Asia/Jakarta');
									$now = date('Y-m-d');
									$now_week = date('oW', strtotime($now));
									$now_month = date('Y-m');
									$now_year = date('Y');

									$tocheck_week = date('oW', strtotime($row->date_tocheck));
									$tocheck_month = date('Y-m', strtotime($row->date_tocheck));
									$tocheck_year = date('Y', strtotime($row->date_tocheck));

									$show_d = date('D', strtotime($row->date_tocheck));
									$show_m = date('D - M');
									$show_clean = date('Y - M - d', strtotime($row->date_tocheck));
									?>

									<?php if($now == $row->date_tocheck): ?>
										<span class="media-annotation dotted"><?= $row->time ?></span>
									<?php elseif($now_week == $tocheck_week && $now != $row->date_tocheck): ?>
										<span class="media-annotation dotted"><?= $show_d ?></span>
									<?php elseif($now_month != $tocheck_month && $now_year == $tocheck_year): ?>
										<span class="media-annotation dotted"><?= $show_m ?></span>
									<?php else: ?>
										<span class="media-annotation dotted"><?= $show_clean ?></span>
									<?php endif; ?>

								</div>

								<?php 
								$msg = "";
								if(strlen($row->msg) > 30){
									$msg = substr($row->msg, 0, -3) . '...';
								}else{
									$msg = $row->msg;
								}
								?>

								<a href="<?= base_url('account/messages/convo/'.$row->id_convo) ?>" class="text-semibold" style="text-decoration: none; color:inherit;" ><span><?= $msg ?></span></a>

							</div>

						</li>

					<?php endforeach; ?>


						<!-- <li class="media date-step text-muted">
							<span>Saturday, Feb 12</span>
						</li>
					-->
					


				</ul>


			</div>
		</div>
		<!-- /left annotation position-->



	</div>
	<div class="col-lg-3">



		<!-- Navigation -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Navigation</h6>
			</div>

			<div class="list-group no-border no-padding-top">
				<a href="<?= base_url('account/profile') ?>" class="list-group-item"><i class="icon-user"></i> My profile</a>
				<?php if($user_lvl_name == "Seller"): ?>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item" data-toggle="tab"><i class="icon-cash3"></i> Riwayat saldo</a>
				<?php endif; ?>
				<a href="<?= base_url('account/messages') ?>" class="list-group-item"><i class="icon-bubbles7"></i> Pesan</a>
				<?php if($user_lvl_name == "Seller"): ?>
					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-store2"></i> Toko </a>
				<?php else: ?>
					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-location4"></i> Alamat </a>
				<?php endif; ?>
				
				<?php if($user_lvl_name == "Seller"): ?>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Penjualan </a>
				<?php else: ?>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Pembelian </a>
				<?php endif; ?>

				<?php if($user_lvl_name != "Seller"): ?>

					<div class="list-group-divider"></div>

					<a data-toggle="modal" class="list-group-item" data-target="#modal_req_seller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Seller</span></a>

					<a data-toggle="modal" class="list-group-item" data-target="#modal_req_reseller_<?= $data_user["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Re-seller</span></a>

					<div class="list-group-divider"></div>

				<?php endif; ?>

				<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" "><i class="icon-cog3"></i> Pengaturan akun</a>
			</div>
		</div>
		<!-- /navigation -->


	</div>
</div>
<!-- /messages -->



</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
