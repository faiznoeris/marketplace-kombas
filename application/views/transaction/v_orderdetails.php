<!-- Content area -->
<div class="content">		 
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

								<?php $prod_detail = $this->m_products->getproduct($prods->id_product)->row() ?>
								<?php $id_seller = $this->m_shop->selectidshop($prod_detail->id_shop)->row()->id_user ?>
								<?php $seller = $this->m_users->select($id_seller)->row()->username ?>

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
