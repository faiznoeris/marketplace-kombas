<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Data Pembelian</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li class="active">Data Pembelian</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">


		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><b>Status Pembelian</b></h5>
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
						<th>Metode Pembayaran</th>
						<th>Tanggal</th>
						<th>Resi</th>
						<th>Status</th>
						<th class="text-center">Konfirmasi</th>
						
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_pembelian as $row) { ?>

					<?php 
					if(empty($row->resi)){
						$resi = "-";
					}else{
						$resi = $row->resi;
					}
					?>

					<tr>
						<td><?= $row->id_transaction ?></td>
						<td><?= $row->nama_product ?></td>
						<td><?= $row->qty ?></td>
						<td><?= $row->totalprice ?></td>
						<td><?= $row->paymentmethod ?></td>
						<td><?= $row->date ?></td>
						<td><?= $resi ?></td>
						<td><?= $row->status ?></td>

						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<?php if($row->trf_received_sts_seller == "0" && $row->trf_received_sts_buyer == "0" && $row->barang_diterima == "0"):?>
											<li><a href="<?= base_url('dashboard/pembelian/konfirmasitransfer/'.$row->id_transaction) ?>"><i class="icon-checkmark3"></i> Transfer Dikirim</a></li>
										<?php else: ?>
											<li class="disabled"><a><i class="icon-checkmark3"></i> Transfer Dikirim</a></li>
										<?php endif; ?>
										
										<?php if($row->trf_received_sts_seller == "1" && $row->trf_received_sts_buyer == "1" && $row->barang_diterima == "0"):?>
											<li><a href="<?= base_url('Pembelian/barangditerima/'.$row->id_transaction) ?>"><i class="icon-checkmark3"></i> Barang Diterima</a></li>
										<?php else: ?>
											<li class="disabled"><a><i class="icon-checkmark3"></i> Barang Diterima</a></li>
										<?php endif; ?>

									</ul>
								</li>
							</ul>
						</td>

					</tr>

					<?php } ?>

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