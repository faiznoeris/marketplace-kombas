<!-- Content area -->
<div class="content">		 
	<!-- Invoice template -->
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
					<img src="<?= base_url('assets/images/logo_demo.png') ?>" class="content-group mt-10" alt="" style="width: 120px;">
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
						<li><span class="text-semibold">Normand axis LTD</span></li>
						<li><?= $shipment->alamat ?>, <?= $shipment->kodepos ?></li>
						<li>London E1 8BF</li>
						<li>United Kingdom</li>
						<li><?= $shipment->telephone ?></li>
						<li><a href="#">rebecca@normandaxis.ltd</a></li>
					</ul>
				</div>

				<div class="col-md-6 col-lg-3 content-group">
					<span class="text-muted">Payment Details:</span>
					<ul class="list-condensed list-unstyled invoice-payment-details">
						<li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
						<li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
						<li>Country: <span>United Kingdom</span></li>
						<li>City: <span>London E1 8BF</span></li>
						<li>Address: <span>3 Goodman Street</span></li>
						<li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
						<li>SWIFT code: <span class="text-semibold">BPT4E</span></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-lg">
				<thead>
					<tr>
						<th>Description</th>
						<th class="col-sm-1">Rate</th>
						<th class="col-sm-1">Hours</th>
						<th class="col-sm-1">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $cart = unserialize($trans_history->cart); ?>

					<?php foreach($cart as $items): ?>

						<tr>
							<td>
								<h6 class="no-margin"><?= $items['name'] ?></h6>
								<span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
							</td>
							<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
							<td><?= number_format($items['berat'], 0, ',', '.') ?></td>
							<td><span class="text-semibold">$3,990</span></td>
						</tr>

					<?php endforeach; ?>
				
				</tbody>
			</table>
		</div>

		<div class="panel-body">
			<div class="row invoice-payment">
				<div class="col-sm-7">
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
										<td class="text-right">$7,000</td>
									</tr>
									<tr>
										<th>Tax: <span class="text-regular">(25%)</span></th>
										<td class="text-right">$1,750</td>
									</tr>
									<tr>
										<th>Total:</th>
										<td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- <div class="text-right">
							<button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send invoice</button>
						</div> -->
					</div>
				</div>
			</div>

			<h6>Other information</h6>
			<p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
		</div>
	</div>
	<!-- /invoice template -->



	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"><center>Order Details <br><span style="font-size: 17px; font-style: italic;">#<b><?= $trans_history->id_transaction ?></b> &emsp;|&emsp; placed on: <b><?= $trans_history->date ?></b></span></center></h5>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<center>
						<h5>Shipping Information</h5>
						<hr class="featurette-divider w-25" style="margin-top: 15px; margin-bottom: 25px;">
						<span>
							a.n <?= $shipment->atasnama ?><br>
							<?= $shipment->alamat ?>, <?= $shipment->kodepos ?><br>
							<?= $shipment->telephone ?>
						</span>
					</center>
				</div>
				<!-- <div class="col-sm-6">
					<center>
						<h5>Payment Method</h5>
						<hr class="featurette-divider w-25" style="margin-top: 15px; margin-bottom: 25px;">
						<span>
							<?= $trans_history->paymentmethod ?>
						</span>
					</center>
				</div> -->
			</div>

			<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

			<div class="row">

				<center>
					<table class="table table-responsive w-75">
						<thead class="thead-default">
							<tr>
								<th width="5%">#</th>
								<!-- <th width="15%">Kode Barang</th> -->
								<th width="15%">Seller</th>
								<th width="20%">Gambar</th>
								<th width="45%">Nama Barang</th>
								<th width="15%">Jumlah</th>
								<th width="25%">Harga</th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1; ?>

							<?php foreach($trans_history_prod as $prods): ?>

								<?php $prod_detail = $this->M_Index->data_productedit_getproduct($prods->id_product)->row() ?>
								<?php $id_seller = $this->M_Index->data_productview_getshop($prod_detail->id_shop)->row()->id_user ?>
								<?php $seller = $this->M_Index->data_productview_getuser($id_seller)->row()->username ?>

								<tr>
									<td><?= $i ?></td>
									<td><?= $seller ?></td>
									<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="130" height="130"></td>
									<td><a href="<?= base_url('product/'.$prods->id_product) ?>"><?= $prod_detail->nama_product ?> (<?= number_format($prods->berat, 0, ',', '.') ?> gram)</a></td>
									<td><?= $prods->qty ?></td>
									<td>Rp. <?= number_format($prods->harga, 0, ',', '.') ?></td>

								</tr>

								<?php $i++ ?>

							<?php endforeach; ?>

							<tr>
								<th scope="row"></th>
								<td colspan="4" class="text-center"><b>SUB-TOTAL</b></td>
								<td colspan="5"><b>Rp. <?= number_format($trans_history->totalprice, 0, ',', '.') ?></b></td>
							</tr>

							
							<tr>
								<th scope="row"></th>
								<td colspan="4" class="text-center"><b>ONGKIR</b></td>
								<td colspan="5"><b>Rp. <?= number_format($trans_history->totalongkir, 0, ',', '.') ?></b></td>
							</tr>


							<tr>
								<th scope="row"></th>
								<td colspan="4" class="text-center"><b>TOTAL HARGA + ONGKIR</b></td>
								<td colspan="5"><b>Rp. <?= number_format($trans_history->totalprice + $trans_history->totalongkir, 0, ',', '.') ?></b></td>
							</tr>
						</tbody>
					</table>
				</center>

			</div> <!-- /row -->

			<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

			<center>
				<h2>Transfer</h2>
				<span>Pilih salah satu dari rekening bank dibawah <br>untuk mentransfer dana pembelian<br>*<b>Semua rekening Atas Nama: PT. Kombas</b></span><br><br>
				<table>
					
					<?php foreach($data_bank as $row): ?>
						<tr>
							<td class="text-center" style="padding-right:10px"><?= $row->no_rekening ?></td>
							<td class="text-center"><?= $row->nama_bank ?></td>
						</tr>
					<?php endforeach; ?>

				</table>
				<br>
				<span style="font-size: 25px;"><b>Rp. <?= number_format($trans_history->totalprice + $trans_history->totalongkir, 0, ',', '.') ?></b></span>
				<br>
				<span>Harap melakukan Transfer <br>sesuai dengan jumlah yang ada diatas</span>
			</center>

			<div class="row">

				<div class="col-sm-6">
					
				</div>

				<div class="col-sm-6">
					
				</div>

			</div>

			<center><hr class="featurette-divider w-75" style="margin-top: 25px; margin-bottom: 55px;"></center>

			<div class="text-center">
				<a class="btn btn-primary" href="<?= base_url('dashboard/pembelian') ?>">Konfirmasi</a>
				<a class="btn btn-primary" href="<?= base_url('category') ?>">Lanjut Belanja</a>
			</div>
		</div>
	</div>
</div>
<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
