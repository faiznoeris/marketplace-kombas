<div class="content">

	<?php if($user_lvl_name == 'User'): ?>
		<!-- Cover area --> 
		<div class="panel panel-remove-outline profile-cover">
			<div class="profile-cover-img" style="background-image: url(<?= base_url('assets/images/login_cover.jpg') ?>)"></div>
			<div class="media">
				<!-- <div class="media-left">
					<a href="#" class="profile-thumb">
						<img src="<?= base_url($session['ava_path']) ?>" class="img-circle img-md" alt="">
					</a>
				</div> -->

				<div class="media-body">
					<h1><?= $session["nama_lgkp"] ?> <small class="display-block"><?= $user_lvl_name ?></small></h1>
				</div>

				<div class="media-right media-middle">
					<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
						<li><a href="#" class="btn btn-default"><i class="icon-file-picture position-left"></i> Cover image</a></li>
						<li><a href="#" class="btn btn-default"><i class="icon-file-stats position-left"></i> Statistics</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /cover area -->
	<?php endif; ?>

	<!-- User profile -->
	<div class="row">
		<div class="col-lg-9">
			<div class="tabbable">
				<div class="tab-content">
					<div class="tab-pane fade in active" id="activity">

						<div class="panel panel-flat timeline-content">
							<div class="panel-heading">
								<h6 class="panel-title">Daily statistics</h6>
								<div class="heading-elements">
									<span class="heading-text"><i class="icon-history position-left text-success"></i> Updated 3 hours ago</span>

									<ul class="icons-list">
										<li><a data-action="reload"></a></li>
									</ul>
								</div>
							</div>

							<div class="panel-body">
								<div class="chart-container">
									<div class="chart has-fixed-height" id="sales"></div>
								</div>
							</div>
						</div>

					</div>


					<div class="tab-pane fade" id="schedule">

						<!-- Orders history (datatable) -->
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Orders history (Datatable)</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>

							<table class="table table-orders-history text-nowrap">
								<thead>
									<tr>
										<th>Status</th>
										<th>Product name</th>
										<th>Size</th>
										<th>Colour</th>
										<th>Article number</th>
										<th>Units</th>
										<th>Price</th>
										<th class="text-center"><i class="icon-arrow-down12"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_pembelian as $row): ?>
										<?php $cart = unserialize($row->cart) ;?>
										<?php foreach ($cart as $items): ?>

											<tr>
												<td>1. New orders</td>
												<td>
													<div class="media">
														<a href="#" class="media-left">
															<img src="assets/images/placeholder.jpg" height="60" class="" alt="">
														</a>

														<div class="media-body media-middle">
															<a href="#" class="text-semibold"><?= $items['name'] ?></a>
															<div class="text-muted text-size-small">
																<span class="status-mark bg-grey position-left"></span>
																Processing
															</div>
														</div>
													</div>
												</td>
												<td>34cm x 29cm</td>
												<td>Orange</td>
												<td>
													<a href="#">1237749</a>
												</td>
												<td>1</td>
												<td>
													<h6 class="no-margin text-semibold">&euro; 79.00</h6>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-truck"></i> Track parcel</a></li>
																<li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
																<li><a href="#"><i class="icon-wallet"></i> Payment details</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-warning2"></i> Report problem</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endforeach; ?>


									<tr>
										<td>2. Shipped orders</td>
										<td>
											<div class="media">
												<a href="#" class="media-left">
													<img src="assets/images/placeholder.jpg" height="60" class="" alt="">
												</a>

												<div class="media-body media-middle">
													<a href="#" class="text-semibold">Cambridge Jacket</a>
													<div class="text-muted text-size-small">
														<span class="status-mark bg-success position-left"></span>
														Shipped
													</div>
												</div>
											</div>
										</td>
										<td>XL</td>
										<td>Nomad/Railroad</td>
										<td>
											<a href="#">475839</a>
										</td>
										<td>1</td>
										<td>
											<h6 class="no-margin text-semibold">&euro; 175.00</h6>
										</td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-truck"></i> Track parcel</a></li>
														<li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
														<li><a href="#"><i class="icon-wallet"></i> Payment details</a></li>
														<li class="divider"></li>
														<li><a href="#"><i class="icon-warning2"></i> Report problem</a></li>
													</ul>
												</li>
											</ul>
										</td>
									</tr>

									

									<tr>
										<td>3. Cancelled orders</td>
										<td>
											<div class="media">
												<a href="#" class="media-left">
													<img src="assets/images/placeholder.jpg" height="60" class="" alt="">
												</a>

												<div class="media-body media-middle">
													<a href="#" class="text-semibold">Tinder Backpack</a>
													<div class="text-muted text-size-small">
														<span class="status-mark bg-danger position-left"></span>
														Cancelled
													</div>
												</div>
											</div>
										</td>
										<td>42cm x 26cm</td>
										<td>Dark Tide Twill</td>
										<td>
											<a href="#">4759383</a>
										</td>
										<td>2</td>
										<td>
											<h6 class="no-margin text-semibold">&euro; 180.00</h6>
										</td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-truck"></i> Track parcel</a></li>
														<li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
														<li><a href="#"><i class="icon-wallet"></i> Payment details</a></li>
														<li class="divider"></li>
														<li><a href="#"><i class="icon-warning2"></i> Report problem</a></li>
													</ul>
												</li>
											</ul>
										</td>
									</tr>

									
								</tbody>
							</table>
						</div>
						<!-- /orders history (datatable) -->


						<!-- Available hours -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Available hours</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>

							<div class="panel-body">
								<div class="chart-container">
									<div class="chart has-fixed-height" id="plans"></div>
								</div>
							</div>
						</div>
						<!-- /available hours -->


					</div>


					<div class="tab-pane fade" id="settings">

						<!-- Profile info -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Profile information</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>

							<div class="panel-body">
								<form action="#">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Username</label>
												<input type="text" value="Eugene" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Full name</label>
												<input type="text" value="Kopyov" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Address line 1</label>
												<input type="text" value="Ring street 12" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Address line 2</label>
												<input type="text" value="building D, flat #67" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<label>City</label>
												<input type="text" value="Munich" class="form-control">
											</div>
											<div class="col-md-4">
												<label>State/Province</label>
												<input type="text" value="Bayern" class="form-control">
											</div>
											<div class="col-md-4">
												<label>ZIP code</label>
												<input type="text" value="1031" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Email</label>
												<input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Your country</label>
												<select class="select">
													<option value="germany" selected="selected">Germany</option> 
													<option value="france">France</option> 
													<option value="spain">Spain</option> 
													<option value="netherlands">Netherlands</option> 
													<option value="other">...</option> 
													<option value="uk">United Kingdom</option> 
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Phone #</label>
												<input type="text" value="+99-99-9999-9999" class="form-control">
												<span class="help-block">+99-99-9999-9999</span>
											</div>

											<div class="col-md-6">
												<label class="display-block">Upload profile image</label>
												<input type="file" class="file-styled">
												<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
											</div>
										</div>
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</form>
							</div>
						</div>
						<!-- /profile info -->


						<!-- Account settings -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Account settings</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>

							<div class="panel-body">
								<form action="#">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Username</label>
												<input type="text" value="Kopyov" readonly="readonly" class="form-control">
											</div>

											<div class="col-md-6">
												<label>Current password</label>
												<input type="password" value="password" readonly="readonly" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>New password</label>
												<input type="password" placeholder="Enter new password" class="form-control">
											</div>

											<div class="col-md-6">
												<label>Repeat password</label>
												<input type="password" placeholder="Repeat new password" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Profile visibility</label>

												<div class="radio">
													<label>
														<input type="radio" name="visibility" class="styled" checked="checked">
														Visible to everyone
													</label>
												</div>

												<div class="radio">
													<label>
														<input type="radio" name="visibility" class="styled">
														Visible to friends only
													</label>
												</div>

												<div class="radio">
													<label>
														<input type="radio" name="visibility" class="styled">
														Visible to my connections only
													</label>
												</div>

												<div class="radio">
													<label>
														<input type="radio" name="visibility" class="styled">
														Visible to my colleagues only
													</label>
												</div>
											</div>

											<div class="col-md-6">
												<label>Notifications</label>

												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" checked="checked">
														Password expiration notification
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" checked="checked">
														New message notification
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" checked="checked">
														New task notification
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled">
														New contact request notification
													</label>
												</div>
											</div>
										</div>
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</form>
							</div>
						</div>
						<!-- /account settings -->

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3">

			<!-- User thumbnail -->
			<div class="thumbnail">
				<div class="thumb thumb-slide">
					<img src="<?= base_url($session['ava_path']) ?>" alt="">
					<div class="caption">
						<span>
							<a href="#" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
							<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
						</span>
					</div>
				</div>

				<div class="caption text-center">
					<h6 class="text-semibold no-margin">
						<?= $session["nama_lgkp"] ?>
						<small class="display-block"><?= $user_lvl_name ?></small>
						<small class="display-block">Rp. <?= number_format($user_data->saldo, 0, ',', '.') ?></small>
					</h6>

				</div>
			</div>
			<!-- /user thumbnail -->


			<!-- Navigation -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Navigation</h6>
				</div>

				<div class="list-group no-border no-padding-top">
					<a href="#" class="list-group-item"><i class="icon-user"></i> My profile</a>
					<a href="#" class="list-group-item"><i class="icon-cash3"></i> Riwayat saldo</a>
					<a href="#" class="list-group-item"><i class="icon-location4"></i> Alamat </a>
					<!-- <div class="list-group-divider"></div> -->
					<a href="#" class="list-group-item"><i class="icon-history"></i> Pembelian <span class="badge bg-teal-400 pull-right">48</span></a>
					<a href="#" class="list-group-item"><i class="icon-cog3"></i> Pengaturan akun</a>
				</div>
			</div>
			<!-- /navigation -->


			


			<!-- Balance chart -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Balance changes</h6>
					<div class="heading-elements">
						<span class="heading-text"><i class="icon-arrow-down22 text-danger"></i> <span class="text-semibold">- 29.4%</span></span>
					</div>
				</div>

				<div class="panel-body">
					<div class="chart-container">
						<div class="chart" id="visits" style="height: 300px;"></div>
					</div>
				</div>
			</div>
			<!-- /balance chart -->


			<!-- Connections -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Latest connections</h6>
					<div class="heading-elements">
						<span class="badge badge-success heading-text">+32</span>
					</div>
				</div>

				<ul class="media-list media-list-linked pb-5">
					<li class="media-header">Office staff</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<span class="media-heading text-semibold">James Alexander</span>
								<span class="media-annotation">UI/UX expert</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-success"></span>
							</div>
						</a>
					</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<span class="media-heading text-semibold">Jeremy Victorino</span>
								<span class="media-annotation">Senior designer</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-danger"></span>
							</div>
						</a>
					</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<div class="media-heading"><span class="text-semibold">Jordana Mills</span></div>
								<span class="text-muted">Sales consultant</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-grey-300"></span>
							</div>
						</a>
					</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<div class="media-heading"><span class="text-semibold">William Miles</span></div>
								<span class="text-muted">SEO expert</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-success"></span>
							</div>
						</a>
					</li>

					<li class="media-header">Partners</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<span class="media-heading text-semibold">Margo Baker</span>
								<span class="media-annotation">Google</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-success"></span>
							</div>
						</a>
					</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<span class="media-heading text-semibold">Beatrix Diaz</span>
								<span class="media-annotation">Facebook</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-warning-400"></span>
							</div>
						</a>
					</li>

					<li class="media">
						<a href="#" class="media-link">
							<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<span class="media-heading text-semibold">Richard Vango</span>
								<span class="media-annotation">Microsoft</span>
							</div>
							<div class="media-right media-middle">
								<span class="status-mark bg-grey-300"></span>
							</div>
						</a>
					</li>
				</ul>
			</div>
			<!-- /connections -->

		</div>
	</div>
	<!-- /user profile -->


</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
