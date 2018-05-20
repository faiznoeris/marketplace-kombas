<!-- Main navbar -->
<div class="navbar navbar-inverse bg-primary-400">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?= base_url('') ?>"><img src="<?= base_url('assets/images/logo_light.png') ?>" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li>
				<a class="navbar-toggler-icon" data-toggle="collapse" data-target="#navbar-mobile" aria-controls="navbar-mobile" aria-expanded="false" aria-label="Toggle navigation">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
			<?php if($active == "shopping"): ?>
				<li><a class="sidebar-mobile-detached-toggle"><i class="icon-grid7"></i></a></li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<div class="navbar-left">
			<ul class="nav navbar-nav">
				<li><a href="<?= base_url('cara-belanja') ?>"><i class="icon-bag position-left"></i> Cara Berbelanja</a></li>
				<li><a href="<?= base_url('account/profile#riwayat') ?>"><i class="icon-checkmark3 position-left"></i> Konfirmasi Pembayaran</a></li>
				<li><a href="<?= base_url('cara-daftar-sebagai-penjual') ?>"><i class="icon-store2 position-left"></i> Cara Mendaftar Sebagai Penjual</a></li>
			</ul>
		</div>
		<div class="navbar-right">

			<ul class="nav navbar-nav">	
				
				
				<?php if($loggedin): ?>

<!-- 					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Activity</span>
							<span class="status-mark border-orange-400"></span>
						</a>

						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Activity
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body width-350">
								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
									</div>

									<div class="media-body">
										<a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
										<div class="media-annotation">4 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-pink-400 btn-rounded btn-icon btn-xs"><i class="icon-paperplane"></i></a>
									</div>

									<div class="media-body">
										Special offers have been sent to subscribed users by <a href="#">Donna Gordon</a>
										<div class="media-annotation">36 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs"><i class="icon-plus3"></i></a>
									</div>

									<div class="media-body">
										<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch in <span class="text-semibold">Limitless</span> repository
										<div class="media-annotation">2 hours ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-purple-300 btn-rounded btn-icon btn-xs"><i class="icon-truck"></i></a>
									</div>

									<div class="media-body">
										Shipping cost to the Netherlands has been reduced, database updated
										<div class="media-annotation">Feb 8, 11:30</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs"><i class="icon-bubble8"></i></a>
									</div>

									<div class="media-body">
										New review received on <a href="#">Server side integration</a> services
										<div class="media-annotation">Feb 2, 10:20</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs"><i class="icon-spinner11"></i></a>
									</div>

									<div class="media-body">
										<strong>January, 2016</strong> - 1320 new users, 3284 orders, $49,390 revenue
										<div class="media-annotation">Feb 1, 05:46</div>
									</div>
								</li>
							</ul>
						</div>
					</li>
				-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bubble8"></i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<?php if($data_msg_new > 0): ?>
							<span class="status-mark border-orange-400"></span>
						<?php endif; ?>
					</a>

					<div class="dropdown-menu dropdown-content width-350">
						<div class="dropdown-content-heading">
							Messages
								<!-- <ul class="icons-list">
									<li><a href="<?= base_url('account/messages/new') ?>"><i class="icon-compose"></i></a></li>
								</ul> -->
							</div>

							<ul class="media-list dropdown-content-body">
								
								<?php foreach($data_msg_limited as $row): ?>


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
											<img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-sm" alt="">
											<span class="badge bg-danger-400 media-badge">
												<?php if($count_msg > 0): ?>
													<?= $count_msg ?>
												<?php endif; ?>
											</span>
										</div>

										<div class="media-body">
											<a href="<?= base_url('account/messages/convo/'.$row->id_convo) ?>" class="media-heading">
												<span class="text-semibold"><?= $connection_detail->username ?></span>

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
												$show_m = date('M - Y');
												$show_clean = date('Y - M - d', strtotime($row->date_tocheck));
												?>

												<?php if($now == $row->date_tocheck): ?>
													<span class="media-annotation pull-right"><?= $row->time ?></span>
												<?php elseif($now_week == $tocheck_week && $now != $row->date_tocheck): ?>
													<span class="media-annotation pull-right"><?= $show_d ?></span>
												<?php elseif($now_month != $tocheck_month && $now_year == $tocheck_year): ?>
													<span class="media-annotation pull-right"><?= $show_m ?></span>
												<?php else: ?>
													<span class="media-annotation pull-right"><?= $show_clean ?></span>
												<?php endif; ?>



												<span class="text-muted" style="white-space: nowrap; text-overflow: ellipsis; width: 200px; display: block; overflow: hidden"><?= $row->msg ?></span>
											</a>
										</div>
									</li>



								<?php endforeach; ?>
							</ul>

							<div class="dropdown-content-footer">
								<a href="<?= base_url('account/messages/') ?>" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
							</div>
						</div>
					</li>	

				<?php endif; ?>

<!-- 				<li>
					<a href="#" class="visible-xs-inline-block">
						<i class="icon-history"></i>
						<span class="visible-xs-inline-block position-right">Transaction History</span>
					</a>
				</li>	

				<li>
					<a href="<?= base_url('cart') ?>" class="visible-xs-inline-block">
						<i class="icon-cart5"></i>
						<span class="visible-xs-inline-block position-right">Cart (<?= $this->cart->total_items(); ?> Items)</span>
					</a>
				</li>	

				<li>
					<a href="<?= base_url('dashboard') ?>" class="visible-xs-inline-block">
						<i class="icon-user"></i>
						<span class="visible-xs-inline-block position-right">Account</span>
					</a>
				</li>	 -->	

				<!-- <li>
					<form class="btn btn-link btn-float text-size-small has-text visible-xs-inline-block">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Cari barang.." style="color: white !important;">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="icon-search4"></i></button>
							</span>
						</div>
					</form>
				</li> -->

			</ul>
		</div>
	</div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-default">

				<div class="page-header-content">
					<div class="page-title">
						<h4>
							<span class="text-semibold">Marketplace Kombas</span>
						</h4>
					</div>

					

					<div class="heading-elements">
						<div class="heading-btn-group">

							<?php if($active != "search"): ?>
								<form class="btn btn-link btn-float text-size-small has-text" method="get" action="<?php echo base_url('search');?>">
									<div class="input-group">
										<input type="search" class="form-control" placeholder="Cari barang.." name="search">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="icon-search4"></i></button>
										</span>
									</div>
								</form>
							<?php endif; ?>

							<?php if($loggedin): ?>
								<a href="<?= base_url('account/profile#riwayat') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-history text-primary"></i><span>Transaction History</span></a>
							<?php endif; ?>

							<?php if($loggedin): ?>
								<?php 
								$user_lvl_name = $this->M_Index->data_productview_getuserlevel($data_user["user_lvl"])->row()->name;
								?> 

								<?php if($user_lvl_name == "User" || $user_lvl_name == "Reseller"): ?>

									<a href="<?= base_url('shopping/cart') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-cart5 text-primary"></i> <span>Cart (<?= $this->cart->total_items(); ?> Items)</span></a>

								<?php endif; ?>
							<?php endif; ?>

							<?php if($loggedin): ?>
								<?php 
								$user_lvl_name = $this->M_Index->data_productview_getuserlevel($data_user["user_lvl"])->row()->name;
								?> 
								<?php if($user_lvl_name == 'Admin' || $user_lvl_name == 'Super Admin'): ?>
									<a href="<?= base_url('dashboard') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-user text-primary"></i> <span> Dashboard</span> </a>
								<?php else: ?>
									<a href="<?= base_url('account/profile') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-user text-primary"></i> <span>Account</span> </a>
								<?php endif; ?>
								<a href="<?= base_url('Auth/logout') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-exit text-primary"></i> <span>Logout</span> </a>
							<?php else: ?>
								<a href="<?= base_url('login') ?>" class="btn btn-link btn-float text-size-small has-text"><i class="icon-user text-primary"></i> <span>Login</span> </a>
							<?php endif; ?>

						</div>
					</div>

				</div>

				<?php if($active == 'account'): ?>
					<!-- Toolbar -->
					<div class="navbar-default navbar-component navbar-xs remove-outline"> <!-- class .navbar removed bc it block the msg view -->
						<ul class="nav navbar-nav visible-xs-block">
							<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
						</ul>

						<div class="navbar-collapse collapse" id="navbar-filter">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#activity" data-toggle="tab"><i class="icon-menu7 position-left"></i> Activity</a></li>
								<li><a href="#riwayat" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Riwayat <span class="badge badge-success badge-inline position-right">32</span></a></li>
								<li><a href="#pengaturan" data-toggle="tab"><i class="icon-cog3 position-left"></i> Pengaturan</a></li>
							</ul>

							
						</div>
					</div>
					<!-- /toolbar -->
				<?php endif; ?>


			</div>
			<!-- /page header -->



