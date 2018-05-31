<!-- Content area -->
<div class="content">		 
	<!-- Invoice template -->

	<?php 
	$total = $trans_history->totalprice + $trans_history->totalongkir;
	$total = substr($total, 0, -3).$trans_history->kode_unik;
	?>



	<div class="col-lg-9">
		

		<div class="panel panel-white">
		<!-- <div class="panel-heading">
			<h6 class="panel-title">Static invoice</h6>
			<div class="heading-elements">
				<button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-file-check position-left"></i> Save</button>
				<button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</button>
			</div>
		</div> -->

		<div class="panel-body no-padding-bottom">
			<div class="row">
				<div class="col-sm-6 content-group">

					<!-- <span class="label label-primary">Primary</span> -->

					<!-- <img src="<?= base_url('assets/images/logo_demo.png') ?>" class="content-group mt-10" alt="" style="width: 120px;"> -->
					<!-- <ul class="list-condensed list-unstyled">
						<li>2269 Elba Lane</li>
						<li>Paris, France</li>
						<li>888-555-2311</li>
					</ul> -->
				</div>

				<div class="col-sm-6 content-group">
					<div class="invoice-details">
						<h5 class="text-uppercase text-semibold">Invoice #<?= $trans_history->id_transaction ?></h5>
						<ul class="list-condensed list-unstyled">
							<li>Date: <span class="text-semibold"><?= $trans_history->date ?></span></li>
							<!-- <li>Due date: <span class="text-semibold">May 12, 2015</span></li> -->
						</ul>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-lg-9 content-group">
					<span class="text-muted">Invoice To:</span>
					<ul class="list-condensed list-unstyled">
						<li><h5><?= $shipment->atasnama ?></h5></li>
						<li>
							<?php for ($i=0; $i < count($rajaongkir_kabupaten['rajaongkir']['results']); $i++): ?>

								<?php if($rajaongkir_kabupaten['rajaongkir']['results'][$i]['city_id'] == $shipment->kabupaten): ?>

									<?= $rajaongkir_kabupaten['rajaongkir']['results'][$i]['city_name'] ?>

								<?php endif; ?>

							<?php endfor; ?>
						</li>
						<li>
							<?php for ($i=0; $i < count($rajaongkir_provinsi['rajaongkir']['results']); $i++): ?>

								<?php if($rajaongkir_provinsi['rajaongkir']['results'][$i]['province_id'] == $shipment->provinsi): ?>

									<?= $rajaongkir_provinsi['rajaongkir']['results'][$i]['province'] ?>

								<?php endif; ?>

							<?php endfor; ?>
						</li>
						<li><?= $shipment->alamat ?>, <?= $shipment->kodepos ?></li>
						<li><?= $shipment->telephone ?></li>
					</ul>
				</div>

				<div class="col-md-6 col-lg-3 content-group">
					<span class="text-muted">Payment Details:</span>
					<ul class="list-condensed list-unstyled invoice-payment-details">
						<li><h5>Total Due: <span class="text-right text-semibold">Rp. <?= number_format($total, 0, ',', '.') ?></span></h5></li>
						<?php if($showconfirmation): ?>
							<li>Bank name (from): <span class="text-semibold"><?= $confirmation->from_bank ?></span></li>
							<li>Bank name (to): <span class="text-semibold"><?= $tobank->nama_bank ?></span></li>
						<?php else: ?>
							<li>Bank name (from): <span class="text-semibold">-</span></li>
							<li>Bank name (to): <span class="text-semibold">-</span></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-lg">
				<thead>
					<tr>
						<th>Produk</th>
						<th class="col-sm-1">Jumlah</th>
						<th class="col-sm-1">Berat</th>
						<th class="col-sm-1">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $cart = unserialize($trans_history->cart); ?>

					<?php foreach($cart as $items): ?>

						<tr>
							<td>
								<div class="media">
									<a target="_blank" href="<?= base_url('product/'.$items['url']) ?>" class="media-left">
										<img src="<?= base_url($items['sampul']) ?>" height="60" class="" alt="">
									</a>

									<div class="media-body media-middle">
										<a target="_blank" href="<?= base_url('product/'.$items['url']) ?>" class="text-semibold"><?= $items['name'] ?></a>
									</div>
								</div>
								
							</td>
							<td><?= $items['qty'] ?></td>
							<td><?= number_format($items['berat'], 0, ',', '.') ?> gram</td>
							<?php 
							if(!empty($items['realprice'])){
								$realprice = $items['realprice'];
								$price = $items['price'];
							}else{
								$realprice = $items['price'];
								$price = $items['price'];
							}
							?>
							<td>
								<span class="text-semibold">
									<?php if($realprice != $price): ?>
										Rp. <?= number_format($price, 0, ',', '.') ?> <strike style="font-size: 12px !important;">Rp. <?= number_format($realprice, 0, ',', '.') ?></strike>
									<?php else: ?>
										Rp. <?= number_format($price, 0, ',', '.') ?>
									<?php endif; ?>
								</span>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>
		</div>

		<div class="panel-body">
			<div class="row invoice-payment">
				<div class="col-sm-7">
					<div class="content-group">
						<h6>Transfer Pembayaran</h6>
						<span>Pilih salah satu dari rekening bank dibawah untuk mentransfer dana pembelian<br>*<b>Semua rekening Atas Nama: PT. Kombas</b></span>
<!-- 						<div class="mb-15 mt-15">
							<img src="<?= base_url('assets/images/signature.png') ?>" class="display-block" style="width: 150px;" alt="">
						</div> -->
						<br><br>
						<table class="table">

							<?php foreach($data_bank as $row): ?>
								<tr>
									<td class="text-center" style="padding-right:10px; border-top: none;"><?= $row->no_rekening ?></td>
									<td class="text-center" style="border-top: none;"><?= $row->nama_bank ?></td>
								</tr>
							<?php endforeach; ?>

						</table>
					</div>
					

					<!-- <div class="content-group">
						<h6>Authorized person</h6>
						<div class="mb-15 mt-15">
							<img src="<?= base_url('assets/images/signature.png') ?>" class="display-block" style="width: 150px;" alt="">
						</div>

						<ul class="list-condensed list-unstyled text-muted">
							<li>Eugene Kopyov</li>
							<li>2269 Elba Lane</li>
							<li>Paris, France</li>
							<li>888-555-2311</li>
						</ul>
					</div> -->
				</div>

				<div class="col-sm-5">
					<div class="content-group">
						<h6>Total due</h6>
						<div class="table-responsive no-border">
							<table class="table">
								<tbody>
									<tr>
										<th>Subtotal:</th>
										<td class="text-right">Rp. <?= number_format($trans_history->totalprice, 0, ',', '.') ?></td>
									</tr>
									<tr>
										<th>Ongkir: <span class="text-regular"></span></th>
										<td class="text-right">Rp. <?= number_format($trans_history->totalongkir, 0, ',', '.') ?></td>
									</tr>
									<tr>
										<th>Kode Unik: <span class="text-regular"></span></th>
										<td class="text-right">Rp. <?= number_format($trans_history->kode_unik, 0, ',', '.') ?></td>
									</tr>
									<tr>
										<th>Total:</th>
										<td class="text-right text-primary"><h5 class="text-semibold">Rp. <?= number_format($total, 0, ',', '.') ?></h5></td>
									</tr>
								</tbody>
							</table>
						</div>
						<span style="color: red; font-size: 12px;">*3 Angka terakhir diganti dengan kode unik. Harap melakukan Transfer <br>sesuai dengan jumlah yang ada diatas.</span>

						<!-- <div class="text-right">
							<button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send invoice</button>
						</div> -->
					</div>
				</div>
			</div>

			<!-- <h6>Other information</h6>
				<p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p> -->
			</div>
		</div>
		<!-- /invoice template -->
	</div>

	<div class="col-lg-3">
		<!-- Navigation -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Navigation</h6>
			</div>

			<div class="list-group no-border no-padding-top">
				<a href="<?= base_url('account/profile') ?>" class="list-group-item"><i class="icon-user"></i> My profile</a>
				<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-cash3"></i> Riwayat saldo</a>
				<a href="<?= base_url('account/messages') ?>" class="list-group-item"><i class="icon-bubbles7"></i> Pesan</a>
				<?php if($user_lvl_name == "Seller"): ?>
					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-store2"></i> Toko </a>
				<?php else: ?>
					<a href="<?= base_url('account/profile#pengaturan') ?>" class="list-group-item" ><i class="icon-location4"></i> Alamat </a>
				<?php endif; ?>
				
				<?php if($user_lvl_name == "Seller"): ?>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Penjualan <span class="badge bg-teal-400 pull-right">48</span></a>
				<?php else: ?>
					<a href="<?= base_url('account/profile#riwayat') ?>" class="list-group-item"><i class="icon-stack2"></i> Pembelian <span class="badge bg-teal-400 pull-right">48</span></a>
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
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
