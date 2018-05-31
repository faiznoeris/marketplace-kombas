<!-- Content area -->
<div class="content">	

	<div class="row">

		<div class="col-lg-9">


			<!-- Basic layout -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<?php if($new == true): ?>
						<h6 class="panel-title">Start Conversation with <i><a target="_blank" href="<?= base_url('u/'.$data_receiver->username) ?>"><?= $data_receiver->username ?></a></i></h6>
					<?php else: ?>
						<h6 class="panel-title">Your Conversation with <i><a target="_blank" href="<?= base_url('u/'.$data_receiver->username) ?>"><?= $data_receiver->username ?></a></i></h6>
					<?php endif; ?>
				</div>

				<div class="panel-body">
					<ul class="media-list chat-list content-group" id="chatbox">

						<?php foreach($data_msg as $row): ?>

							<?php 
							$connection_detail = $this->M_Index->data_order_getuser($row->id_user)->row();
							?>

							<?php if($row->id_user == $data_user["id_user"]): ?>

								

								<li class="media reversed">
									<div class="media-body">
										<div class="media-content"><?= $row->msg ?></div>

										<?php 
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
											<span class="media-annotation display-block mt-10"><?= $row->time ?></span>
										<?php elseif($now_week == $tocheck_week && $now != $row->date_tocheck): ?>
											<span class="media-annotation display-block mt-10"><?= $show_d ?></span>
										<?php elseif($now_month != $tocheck_month && $now_year == $tocheck_year): ?>
											<span class="media-annotation display-block mt-10"><?= $show_m ?></span>
										<?php else: ?>
											<span class="media-annotation display-block mt-10"><?= $show_clean ?></span>
										<?php endif; ?>

									</div>

									<div class="media-right">
										<!-- <a href="assets/images/placeholder.jpg"> -->
											<img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt="">
											<!-- </a> -->
										</div>
									</li>



								<?php else: ?>



									<li class="media">
										<div class="media-left">
											<a href="<?= base_url('u/'.$connection_detail->username) ?>">
												<img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt="">
											</a>
										</div>

										<div class="media-body">
											<div class="media-content"><?= $row->msg ?></div>

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
												<span class="media-annotation display-block mt-10"><?= $row->time ?></span>
											<?php elseif($now_week == $tocheck_week && $now != $row->date_tocheck): ?>
												<span class="media-annotation display-block mt-10"><?= $show_d ?></span>
											<?php elseif($now_month != $tocheck_month && $now_year == $tocheck_year): ?>
												<span class="media-annotation display-block mt-10"><?= $show_m ?></span>
											<?php else: ?>
												<span class="media-annotation display-block mt-10"><?= $show_clean ?></span>
											<?php endif; ?>

										</div>
									</li>

								<?php endif; ?>

							<?php endforeach; ?>

						</ul>
						<?php if($new == true): ?>
							<form method="post" action="<?php echo base_url('Message/send/new/'.$data_receiver->id_user);?>">
							<?php else: ?>
								<form method="post" action="<?php echo base_url('Message/send/'.$this->uri->segment(4)."/".$data_receiver->id_user);?>">
								<?php endif; ?>
								<textarea name="message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

								<div class="row">
									<div class="col-xs-12 text-right">
										<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /basic layout -->

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
