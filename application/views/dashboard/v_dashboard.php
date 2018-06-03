<!-- Content area -->
<div class="content-wrapper">


	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-8">

			<!-- Combination and connection -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Users Registered Pie</h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="chart-container">
								<div class="chart has-fixed-height" id="connect_pie"></div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="chart-container">
								<div class="chart has-fixed-height" id="connect_column"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /combination and connection -->
		</div>

		<div class="col-lg-4">


			<!-- Daily sales -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Latest Transaction</h5>
					
				</div>

				<div class="panel-body">
					<div id="sales-heatmap"></div>
				</div>

				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr>
								<th>Pembeli</th>
								<th>Waktu Order</th>
								<th>Total Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($last_transaction as $row): ?>
								<tr>
									<td>

										<div class="media-body">
											<div class="media-heading">
												<a href="#" class="letter-icon-title"><?= $row->username ?></a>
											</div>

											<div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> <?= $row->nama_userlevel ?></div>
										</div>
									</td>
									<td>
										<span class="text-muted text-size-small"><?= $row->date ?></span>
									</td>
									<td>
										<?php
										$total = $row->totalprice + $row->totalongkir;
										$total = substr($total, 0, -3).$row->kode_unik;
										?>
										<h6 class="text-semibold no-margin">Rp. <?= number_format($total, 0, ',', '.') ?></h6>
									</td>
								</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
				</div>
			</div>
			<!-- /daily sales -->


			<!-- Top Categories -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Top Categories</h5>
				</div>

				<!-- Tabs content -->
				<div class="tab-content">
					<div class="tab-pane active fade in has-padding" id="messages-tue">
						<ul class="media-list">
							<?php foreach($top_categories as $cat): ?>
								<li class="media">
									<div class="media-left media-middle">
										<span class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
											<span class="letter-icon"><?= substr($cat['category'], 0, 1) ?></span>
										</span>
									</div>

									<div class="media-body">
										<?= $cat['category'] ?>
										<span class="display-block text-muted"><i class="icon-eye2 position-left"></i> <b><?= $cat['views'] ?></b> views</span>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>


				</div>
				<!-- /tabs content -->

			</div>
			<!-- /top categories -->




		</div>
	</div>
	<!-- /dashboard content -->

</div>
<!-- /main content -->
