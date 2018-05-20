<!-- Page header -->
<div class="page-header page-header-inverse bg-indigo">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse navbar-transparent">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?= base_url('') ?>"><img src="<?= base_url('assets/images/logo_light.png') ?>" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-grid3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Activity</span>
							<span class="status-mark border-pink-300"></span>
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



					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url($data_session['ava_path']) ?>" class="img-circle img-sm" alt="">
							<span><?= ucfirst($data_session['username']) ?></span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?= base_url('dashboard/account') ?>"><i class="icon-cog5"></i> Account settings</a></li>
							<li><a href="<?= base_url('Auth/logout') ?>"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page header content -->
	<div class="page-header-content">
		<div class="page-title">

			<?php if($active == "dashboard"): ?>
				<h4>Dashboard <small>Good morning, <?= ucfirst($data_session['username']); ?></small></h4>
			<?php elseif($active == "account"): ?>
				<h4>Accoutn Settings</h4>
			<?php elseif($active == "bank"): ?>
				<h4>Bank</h4>
			<?php elseif($active == "category"): ?>
				<h4>Category</h4>
			<?php elseif($active == "exceddeliveryreports"): ?>
				<h4>Reports - Delivery Exceed Deadline</h4>
			<?php elseif($active == "exceddeliveredreports"): ?>
				<h4>Reports - Delivered Exceed Deadline</h4>
			<?php elseif($active == "transactionreports"): ?>
				<h4>Reports - Transfer Confirmation</h4>
			<?php elseif($active == "withdrawreports"): ?>
				<h4>Reports - Withdrawal Confirmation</h4>
			<?php elseif($active == "refund"): ?>
				<h4>Reports - Refund Confirmation</h4>
			<?php elseif($active == "userlist"): ?>
				<h4>User Management - User List</h4>
			<?php elseif($active == "sellerapproval"): ?>
				<h4>User Management - Seller Pending Approval</h4>
			<?php elseif($active == "resellerapproval"): ?>
				<h4>User Management - Reseller Pending Approval</h4>
			<?php endif; ?>
			
		</div>

		<div class="heading-elements">
			<ul class="breadcrumb heading-text">
				<li><a href="<?= base_url('') ?>"><i class="icon-home2 position-left"></i> Home</a></li>

				<?php if($active == "dashboard"): ?>
					<li class="active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
				<?php elseif($active == "account"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="active">Account Settings</li>
				<?php elseif($active == "bank"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="active">Bank</li>
				<?php elseif($active == "category"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="active">Category</li>
				<?php elseif($active == "exceddeliveryreports"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>Reports</li>
					<li class="active">Delivery Exceed Deadline</li>
				<?php elseif($active == "exceddeliveredreports"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>Reports</li>
					<li class="active">Delivered Exceed Deadline</li>
				<?php elseif($active == "transactionreports"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>Reports</li>
					<li class="active">Transfer Confirmation</li>
				<?php elseif($active == "withdrawreports"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>Reports</li>
					<li class="active">Withdrawal Confirmation</li>
				<?php elseif($active == "refund"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>Reports</li>
					<li class="active">Refund Confirmation</li>
				<?php elseif($active == "userlist"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>User Management</li>
					<li class="active">User List</li>
				<?php elseif($active == "sellerapproval"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>User Management</li>
					<li class="active">Seller Pending Approval</li>
				<?php elseif($active == "resellerapproval"): ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li>User Management</li>
					<li class="active">Reseller Pending Approval</li>
				<?php endif; ?>

				
			</ul>
		</div>
	</div>
	<!-- /page header content -->


	<!-- Second navbar -->
	<div class="navbar navbar-inverse navbar-transparent" id="navbar-second">
		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav navbar-nav-material">
				<?php if($active == "dashboard"): ?>
					<li class="active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
				<?php else: ?>
					<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
				<?php endif; ?>

				<?php if($active == "bank" || $active == "category"){
					echo '<li class="dropdown active">';
				}else{
					echo '<li class="dropdown">';
				}
				?>



				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
				<ul class="dropdown-menu width-250">
					<li class="dropdown-header">Website Settings</li>

					<?php if($active == "bank"): ?>
						<li class="active"><a href="<?= base_url('dashboard/bank') ?>"><i class="icon-list2"></i> <span>Bank</span></a></li>
					<?php else: ?>
						<li><a href="<?= base_url('dashboard/bank') ?>"><i class="icon-list2"></i> <span>Bank</span></a></li>
					<?php endif; ?>

					<?php if($active == "category"): ?>
						<li class="active"><a href="<?= base_url('dashboard/category') ?>"><i class="icon-list2"></i> <span> Category</span></a></li>
					<?php else: ?>
						<li><a href="<?= base_url('dashboard/category') ?>"><i class="icon-list2"></i> <span>Category</span></a></li>
					<?php endif; ?>

				</ul>
			</li>


			<?php if($active == "exceddeliveryreports" || $active == "exceddeliveredreports" || $active == "transactionreports" || $active == "withdrawreports" || $active == "refund"){
				echo '<li class="dropdown active">';
			}else{
				echo '<li class="dropdown">';
			}
			?>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>

			<ul class="dropdown-menu width-250">
				<li class="dropdown-header">Reports</li>

				<?php if($active == "exceddeliveryreports"): ?>
					<li class="active"><a href="<?= base_url('dashboard/reports/exceeddeadline/delivery') ?>"><i class="icon-clipboard3"></i> <span>Delivery Exceed Deadline</span></a></li>
				<?php else: ?>
					<li><a href="<?= base_url('dashboard/reports/exceeddeadline/delivery') ?>"><i class="icon-clipboard3"></i> <span>Delivery Exceed Deadline</span></a></li>
				<?php endif; ?>

				<?php if($active == "exceddeliveredreports"): ?>
					<!-- <li class="active"><a href="<?= base_url('dashboard/reports/exceeddeadline/delivered') ?>"><i class="icon-clipboard3"></i> <span>Delivered Exceed Deadline</span></a></li> -->
				<?php else: ?>
					<!-- <li><a href="<?= base_url('dashboard/reports/exceeddeadline/delivered') ?>"><i class="icon-clipboard3"></i> <span>Delivered Exceed Deadline</span></a></li> -->
				<?php endif; ?>

				<?php if($active == "transactionreports"): ?>
					<li class="active"><a href="<?= base_url('dashboard/reports/transaction') ?>"><i class="icon-clipboard3"></i> <span>Transaction Reports</span></a></li>
				<?php else: ?>
					<li><a href="<?= base_url('dashboard/reports/transaction') ?>"><i class="icon-clipboard3"></i> <span>Transaction Reports</span></a></li>
				<?php endif; ?>

				<?php if($active == "withdrawreports"): ?>
					<li class="active"><a href="<?= base_url('dashboard/reports/withdraw') ?>"><i class="icon-clipboard3"></i> <span>Withdraw Reports</span></a></li>
				<?php else: ?>
					<li><a href="<?= base_url('dashboard/reports/withdraw') ?>"><i class="icon-clipboard3"></i> <span>Withdraw Reports</span></a></li>
				<?php endif; ?>

				<?php if($active == "refund"): ?>
					<li class="active"><a href="<?= base_url('dashboard/reports/refund') ?>"><i class="icon-clipboard3"></i> <span>Refund</span></a></li>
				<?php else: ?>
					<li><a href="<?= base_url('dashboard/reports/refund') ?>"><i class="icon-clipboard3"></i> <span>Refund</span></a></li>
				<?php endif; ?>
				
			</ul>
		</li>

		<?php if($active == "userlist" || $active == "sellerapproval" || $active == "resellerapproval"){
			echo '<li class="dropdown active">';
		}else{
			echo '<li class="dropdown">';
		}
		?>
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">User Management <span class="caret"></span></a>

		<ul class="dropdown-menu width-250">
			<li class="dropdown-header">User Management</li>

			<?php if($active == "userlist"): ?>
				<li class="active"><a href="<?= base_url('dashboard/users') ?>"><i class="icon-users"></i> <span>Users List</span></a></li>
			<?php else: ?>
				<li><a href="<?= base_url('dashboard/users') ?>"><i class="icon-users"></i> <span>Users List</span></a></li>
			<?php endif; ?>


			<li class="dropdown-header">Approval</li>




			<?php if($active == "sellerapproval"): ?>
				<li class="active"><a href="<?= base_url('dashboard/pendingapproval/seller') ?>"><i class="icon-hour-glass3"></i> <span>Seller Pending Approval</span></a></li>
			<?php else: ?>
				<li><a href="<?= base_url('dashboard/pendingapproval/seller') ?>"><i class="icon-hour-glass3"></i> <span>Seller Pending Approval</span></a></li>
			<?php endif; ?>

			<?php if($active == "resellerapproval"): ?>
				<li class="active"><a href="<?= base_url('dashboard/pendingapproval/reseller') ?>"><i class="icon-hour-glass3"></i> <span>Re-Seller Pending Approval</span></a></li>
			<?php else: ?>
				<li><a href="<?= base_url('dashboard/pendingapproval/reseller') ?>"><i class="icon-hour-glass3"></i> <span>Re-seller Pending Approval</span></a></li>
			<?php endif; ?>

		</ul>
	</li>


</ul>


</div>
</div>
<!-- /second navbar -->




</div>
<!-- /page header -->
