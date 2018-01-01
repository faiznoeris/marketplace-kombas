			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?= base_url('/assets/dashboard-limitless/images/placeholder.jpg') ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<!-- style="margin-top: 10px;" -->
									<span class="media-heading text-semibold"><?= $data_user["nama_lgkp"] ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-person text-size-small"></i> &nbsp;<?= $user_lvl ?>
									</div>
								</div>


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


								<?php if($user_lvl == "Admin"): ?>

									<li class="navigation-header"><span>Admin Settings</span> <i class="icon-menu" title="Admin Settings pages"></i></li>
									<?php if($active == "web-settings"): ?>
										<li class="active"><a href="<?= base_url('dashboard/webettings') ?>"><i class="icon-earth"></i> <span>Website Settings</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/websettings') ?>"><i class="icon-earth"></i> <span>Website Settings</span></a></li>
									<?php endif; ?>

									<?php if($active == "category"): ?>
										<li class="active"><a href="<?= base_url('dashboard/listcategory') ?>"><i class="icon-list2"></i> <span>Products Category</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/listcategory') ?>"><i class="icon-list2"></i> <span>Products Category</span></a></li>
									<?php endif; ?>

								<?php endif; ?>




								<li class="navigation-header"><span>User Settings</span> <i class="icon-menu" title="Settings pages"></i></li>

								<?php if($user_lvl == "Reguler User" || $user_lvl == "Dropshipper"): ?>
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



								<?php if($user_lvl == "Reguler User" || $user_lvl == "Dropshipper"): ?>

									<?php if($active == "pembelian"): ?>
										<li class="active"><a href="<?= base_url('dashboard/pembelian') ?>"><i class="icon-bag"></i> <span>Pembelian</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/pembelian') ?>"><i class="icon-bag"></i> <span>Pembelian</span></a></li>
									<?php endif; ?>

									<li><a href="<?= base_url('Account/upgradeseller/'.$data_user["id_user"]) ?>"><i class="icon-store"></i> <span>Upgrade account menjadi Seller</span></a></li>

								<?php elseif($user_lvl == "Seller"): ?>

									<?php if($active == "toko"): ?>
										<li class="active"><a href="<?= base_url('dashboard/toko') ?>"><i class="icon-store2"></i> <span>Toko</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/toko') ?>"><i class="icon-store2"></i> <span>Toko</span></a></li>
									<?php endif; ?>

								<?php endif; ?>

								


								<?php if($user_lvl == "Admin"): ?>

									<li class="navigation-header"><span>User Management</span> <i class="icon-menu" title="User Management Pages"></i></li>

									<?php if($active == "adduser"): ?>
										<li class="active"><a href="<?= base_url('dashboard/adduser') ?>"><i class="icon-user-plus"></i> <span>Add User</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/adduser') ?>"><i class="icon-user-plus"></i> <span>Add User</span></a></li>
									<?php endif; ?>

									<?php if($active == "daftaruser"): ?>
										<li class="active"><a href="<?= base_url('dashboard/daftaruser') ?>"><i class="icon-users"></i> <span>Daftar User</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/daftaruser') ?>"><i class="icon-users"></i> <span>Daftar User</span></a></li>
									<?php endif; ?>

									<?php if($active == "adminprivilege"): ?>
										<li class="active"><a href="<?= base_url('dashboard/adminprivilege') ?>"><i class="icon-user-tie"></i> <span>Admin Privilege</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/adminprivilege') ?>"><i class="icon-user-tie"></i> <span>Admin Privilege</span></a></li>
									<?php endif; ?>

									<?php if($active == "sellerapproval"): ?>
										<li class="active"><a href="<?= base_url('dashboard/sellerpending') ?>"><i class="icon-hour-glass3"></i> <span>Seller Pending Approval</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/sellerpending') ?>"><i class="icon-hour-glass3"></i> <span>Seller Pending Approval</span></a></li>
									<?php endif; ?>

								<?php endif; ?>


								



								<?php if($user_lvl == "Seller"): ?>

									<li class="navigation-header"><span>Product Management</span> <i class="icon-menu" title="Product Management Pages"></i></li>

									<?php if($active == "addproduct"): ?>
										<li class="active"><a href="<?= base_url('dashboard/addproduct') ?>"><i class="icon-file-plus"></i> <span>Add Product</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/addproduct') ?>"><i class="icon-file-plus"></i> <span>Add Product</span></a></li>
									<?php endif; ?>

									<?php if($active == "listproduct"): ?>
										<li class="active"><a href="<?= base_url('dashboard/sellerpending') ?>"><i class="icon-files-empty"></i> <span>Daftar Product</span></a></li>
									<?php else: ?>
										<li><a href="<?= base_url('dashboard/listproduct') ?>"><i class="icon-files-empty"></i> <span>Daftar Product</span></a></li>
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