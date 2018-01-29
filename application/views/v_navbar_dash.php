<!-- Main navbar -->
<div class="navbar navbar-default header-highlight">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?= base_url('') ?>"><img src="<?= base_url('/assets/dashboard-limitless/images/logo_light.png') ?>" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

		</ul>

		<?php if($user_lvl_name != "Super Admin" && $user_lvl_name != "Admin"): ?>
			<div class="navbar-right">
				<ul class="nav navbar-nav">


					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bubbles4"></i>
							<span class="visible-xs-inline-block position-right">Messages</span>
							<!-- <span class="badge bg-warning-400">2</span> -->
						</a>

						<div class="dropdown-menu dropdown-content width-350">
							<div class="dropdown-content-heading">
								Messages
								<!-- <ul class="icons-list">
									<li><a href="#"><i class="icon-compose"></i></a></li>
								</ul> -->
							</div>

							<ul class="media-list dropdown-content-body">

								<?php foreach($data_connection_limited as $row): ?>

									<?php if($row->id_receiver != $session["id_user"]): ?>

										<?php 
										$connection_detail = $this->m_users->select($row->id_receiver)->row();
										?>

										<li class="media">
											<div class="media-left">
												<img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-sm" alt="">
												<!-- <span class="badge bg-danger-400 media-badge">5</span> -->
											</div>

											<div class="media-body">
												<a href="<?= base_url('dashboard/messages/'.$row->id_receiver) ?>" class="media-heading">
													<span class="text-semibold"><?= $connection_detail->username ?></span>
													<span class="media-annotation pull-right"><?= $row->date ?></span>
												</a>

												<?php 
												$msg = "";
												if(strlen($row->msg) > 30){
													$msg = substr($row->msg, 0, -3) . '...';
												}else{
													$msg = $row->msg;
												}
												?>

												<span class="text-muted"><?= $msg ?></span>
											</div>
										</li>

									<?php endif; ?>

								<?php endforeach; ?>

							</ul>

							<div class="dropdown-content-footer">
								<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
							</div>
						</div>
					</li>

				</ul>
			</div>
		<?php endif; ?>
	</div>
</div>
<!-- /main navbar -->