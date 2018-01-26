<div id="jGrowl-pembelian-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Basic modal -->
<div id="modal_req_seller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradeseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Basic modal -->
<div id="modal_req_reseller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradereseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->

<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pembelian</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Pembelian</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Daftar Order</b></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Id Transaksi</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Kurir & Paket</th>
						<th>Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_pembelian as $row): ?>

						<?php

						$prods = explode(',', $row->id_product); 
						$shops = explode(',', $row->id_shop); 

						//removing whitespace and counting how many product & shop
						$index_prod = array_search('', $prods); 
						if ( $index_prod !== false ) {
							unset( $prods[$index_prod] );
						}
						$index_shop = array_search('', $shops); 
						if ( $index_shop !== false ) {
							unset( $shops[$index_shop] );
						}

						?>

						<?php if(count($prods) < 2): ?>

							<tr>
								<td><?= count($prods) ?></td>
								<td></td>
								<td></td>
							</tr>

						<?php else: ?>

							<?php $first = true; ?>

							<?php foreach($prods as $p): ?>

								<?php 

								// $shop_detail = $this->m_shop->selectidshop($s)->row();
								// $seller_detail = $this->m_users->select($shop_detail->id_user)->row();
								$prod_detail = $this->m_products->getproduct($p)->row();
								$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();
								$history_seller = $this->m_transaction_history_seller->select2('transaction','shop',$row->id_transaction,$prod_detail->id_shop)->row();

								?>

								<?php if($first): ?>

									<tr>
										<td rowspan="<?= count($prods) ?>"><?= $row->id_transaction ?></td>
										<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
										<td><?= $history_product->qty ?></td>
										<td><?= $history_product->harga ?></td>
										<td rowspan="<?= count($prods) ?>"><?= strtoupper($history_seller->kurir) ?>&emsp;|&emsp;<?= $history_seller->jenis_paket ?></td>
										<td rowspan="<?= count($prods) ?>"><?= $history_seller->status ?></td>
										<td rowspan="<?= count($prods) ?>" class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">

														<?php if($history_seller->status == "On Delivery"):?>
															<li><a data-toggle="modal" data-target="#modal_brgditerima_<?= $row->id_transaction ?>") ?> Barang Diterima</a></li>
														<?php else: ?>
															<li class="disabled"><a> Barang Diterima</a></li>
														<?php endif; ?>

													</ul>
												</li>
											</ul>
										</td>

										<!-- Basic modal -->
										<div id="modal_brgditerima_<?= $row->id_transaction ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h5 class="modal-title">Konfirmasi Barang Diterima</h5>
													</div>
												

														<div class="modal-body">
															<!-- <h6 class="text-semibold">Text in a modal</h6> -->

															<p>Apakah anda ingin mengkonfirmasi bahwa barang telah diterima?</p>
															<br>
														</div>

														<div class="modal-footer">

															<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
															<a class="btn btn-primary" href="<?php echo base_url('Pembelian/barangditerima/'.$row->id_transaction.'/'.$prod_detail->id_shop);?>"> Confirm</a>

														</div>

												</div>
											</div>
										</div>

									</tr>

									<?php $first = false; ?>

								<?php else: ?>

									<tr>
										<td style="display: none;"></td>
										<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
										<td><?= $history_product->qty ?></td>
										<td><?= $history_product->harga ?></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										
									</tr>

								<?php endif; ?>

							<?php endforeach; ?>

						<?php endif; ?>


					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
		<!-- /basic datatable -->


		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->