			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?= base_url($session['ava_path']) ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<!-- style="margin-top: 10px;" -->
									<span class="media-heading text-semibold"><?= $session["nama_lgkp"] ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-person text-size-small"></i> &nbsp;<?= $user_lvl_name ?>
									</div>
								</div>
								<?php if($user_lvl_name != "Super Admin" && $user_lvl_name != "Admin"): ?>
									<br><span class="media-heading text-semibold">Saldo:&emsp; Rp. <?= number_format($user_data->saldo, 0, ',', '.') ?></span>
								<?php endif; ?>

							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>


								<?php if($active == "dashboard"): ?>
									<li class="active"><a href="<?= base_url('dashboard') ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<?php else: ?>
									<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<?php endif; ?>


								<?php if($user_lvl_name == "Admin" || $user_lvl_name == "Super Admin"): ?>

									<li class="navigation-header"><span>Admin Settings</span> <i class="icon-menu" title="Admin Settings pages"></i></li>
									<?php if($active == "web-settings"): ?>
										<!-- <li class="active"><a href="<?= base_url('dashboard/headers') ?>"><i class="icon-earth"></i> <span>Promo Headers</span></a></li> -->
									<?php else: ?>
										<!-- <li><a href="<?= base_url('dashboard/headers') ?>"><i class="icon-earth"></i> <span>Promo Headers</span></a></li> -->
									<?php endif; ?>

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

								<?php endif; ?>




								<li class="navigation-header"><span>Account Settings</span> <i class="icon-menu" title="Settings pages"></i></li>

								<?php if($user_lvl_name == "User" || $user_lvl_name == "Reseller"): ?>
									<?php if($active == "alamat"): ?>
										<li class="active"><a href="<?= base_url('dashboard/alamat') ?>"><i class="icon-address-book"></i> <span>Alamat</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/alamat') ?>"><i class="icon-address-book"></i> <span>Alamat</span></a></li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($active == "biodata"): ?>
									<li class="active"><a href="<?= base_url('dashboard/biodata') ?>"><i class="icon-user"></i> <span>Biodata</span></a></li>
								<?php else: ?>
									<li><a href="<?= base_url('dashboard/biodata') ?>"><i class="icon-user"></i> <span>Biodata</span></a></li>
								<?php endif; ?>



								<?php if($user_lvl_name == "User" || $user_lvl_name == "Reseller"): ?>

									<?php if($active == "pembelian"): ?>
										<li class="active"><a href="<?= base_url('dashboard/pembelian') ?>"><i class="icon-bag"></i> <span>Pembelian</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/pembelian') ?>"><i class="icon-bag"></i> <span>Pembelian</span></a></li>
									<?php endif; ?>

									<?php 

									$q = $this->db->query("SELECT * FROM pending_approval WHERE id_user = ".$session["id_user"])->num_rows();

									?>

									<?php if($q < 1): ?>

										<li><a data-toggle="modal" data-target="#modal_req_seller_<?= $session["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Seller</span></a></li>

										<li><a data-toggle="modal" data-target="#modal_req_reseller_<?= $session["id_user"] ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Re-seller</span></a></li>

									<?php endif; ?>
									
								<?php endif; ?>


								<?php if($user_lvl_name == "Seller"): ?>

									<li class="navigation-header"><span>Shops</span> <i class="icon-menu" title="Shop pages"></i></li>

									<?php if($active == "shop"): ?>
										<li class="active"><a href="<?= base_url('dashboard/shop') ?>"><i class="icon-store2"></i> <span>Shop</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/shop') ?>"><i class="icon-store2"></i> <span>Shop</span></a></li>
									<?php endif; ?>

									<?php if($active == "penjualan"): ?>
										<li class="active"><a href="<?= base_url('dashboard/penjualan') ?>"><i class="icon-clipboard6"></i> <span>Penjualan</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/penjualan') ?>"><i class="icon-clipboard6"></i> <span>Penjualan</span></a></li>
									<?php endif; ?>

									<?php if($active == "withdraw"): ?>
										<li class="active"><a href="<?= base_url('dashboard/withdraw') ?>"><i class="icon-coin-dollar"></i> <span>Withdraw</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/withdraw') ?>"><i class="icon-coin-dollar"></i> <span>Withdraw</span></a></li>
									<?php endif; ?>

									<li class="navigation-header"><span>Product Management</span> <i class="icon-menu" title="Product Management Pages"></i></li>

									<?php if($active == "addproduct"): ?>
										<li class="active"><a href="<?= base_url('dashboard/products/add') ?>"><i class="icon-file-plus"></i> <span>Add New Product</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/products/add') ?>"><i class="icon-file-plus"></i> <span>Add New Product</span></a></li>
									<?php endif; ?>

									<?php if($active == "listproduct"): ?>
										<li class="active"><a href="<?= base_url('dashboard/products') ?>"><i class="icon-files-empty"></i> <span>Products</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/products') ?>"><i class="icon-files-empty"></i> <span>Products</span></a></li>
									<?php endif; ?>

								<?php endif; ?>

								


								<?php if($user_lvl_name == "Admin" || $user_lvl_name == "Super Admin"): ?>

									<li class="navigation-header"><span>Reports</span> <i class="icon-menu" title="Transaction Reports"></i></li>

									<?php if($active == "exceddeliveryreports"): ?>
										<li class="active"><a href="<?= base_url('dashboard/reports/exceeddeadline/delivery') ?>"><i class="icon-clipboard3"></i> <span>Delivery Exceed Deadline</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/reports/exceeddeadline/delivery') ?>"><i class="icon-clipboard3"></i> <span>Delivery Exceed Deadline</span></a></li>
									<?php endif; ?>

									<?php if($active == "exceddeliveredreports"): ?>
										<li class="active"><a href="<?= base_url('dashboard/reports/exceeddeadline/delivered') ?>"><i class="icon-clipboard3"></i> <span>Delivered Exceed Deadline</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/reports/exceeddeadline/delivered') ?>"><i class="icon-clipboard3"></i> <span>Delivered Exceed Deadline</span></a></li>
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

									<li class="navigation-header"><span>User Management</span> <i class="icon-menu" title="User Management Pages"></i></li>

									<!-- <?php if($active == "adduser"): ?>
										<li class="active"><a href="<?= base_url('dashboard/users/add') ?>"><i class="icon-user-plus"></i> <span>Add User</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/users/add') ?>"><i class="icon-user-plus"></i> <span>Add User</span></a></li>
									<?php endif; ?> -->

									<?php if($active == "userlist"): ?>
										<li class="active"><a href="<?= base_url('dashboard/users') ?>"><i class="icon-users"></i> <span>Users List</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/users') ?>"><i class="icon-users"></i> <span>Users List</span></a></li>
									<?php endif; ?>

								<!-- 	<?php if($active == "adminprivilege"): ?>
										<li class="active"><a href="<?= base_url('dashboard/adminprivilege') ?>"><i class="icon-user-tie"></i> <span>Admin Privilege</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/adminprivilege') ?>"><i class="icon-user-tie"></i> <span>Admin Privilege</span></a></li>
									<?php endif; ?> -->

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

								<?php endif; ?>


								<li class="navigation-header"><span>Logout</span> <i class="icon-menu" title="Product Management Pages"></i></li>

								<li><a href="<?= base_url('Auth/logout') ?>"><i class="icon-exit"></i> <span>Logout</span></a></li>


								<!-- /main -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->