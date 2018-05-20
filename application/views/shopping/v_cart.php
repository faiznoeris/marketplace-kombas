<!-- Content area -->
<div class="content">		 
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Kantong Belanja</h5>
		</div>

		<div class="panel-body">
			<p class="content-group">Barang yang ingin anda pesan akan masuk ke dalam kantong belanja yang dapat dilihat pada tabel dibawah.</p>

			<div class="table-responsive">
				<table class="table table-framed">

					<tbody>
						<?php 
						$i = 1; 
						$total = 0;
						$totaloneprod = 0;
						$cart = $this->cart->contents();


						?>

						<?php foreach ($cart as $items): ?>

							<tr>	
								<td><a href="<?= base_url('/product/'.$items['id_prod']) ?>" class="text-semibold" style="color: black !important;"><img src="<?= base_url($items['sampul']) ?>" width="130" height="130"> &emsp; <?= $items['name'] ?></a></td>
								<td>	
									<div class="quantity" id="Hidden<?= $items['id'] ?>">
										<input type="number" id="qty<?= $items['id'] ?>" min="1" max="100" step="1" value="<?= $items['qty'] ?>" disabled>
										<input type="hidden" id="rowid<?= $items['id'] ?>" value="<?= $items['rowid'] ?>">
										<input type="hidden" id="idprod<?= $items['id'] ?>" value="<?= $items['id_prod'] ?>">
									</div>
								</td>
								<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?> <b style="font-size: 17px !important;">x <?= $items['qty'] ?></b></td>
								<td><b>Rp. <?= number_format($items['price']*$items['qty'], 0, ',', '.') ?></b></td>
								<td><a href="<?= base_url('shopping/removecartitem/'.$items['rowid']) ?>" class="btn bg-danger-400 btn-block"><i class="icon-cart-remove"></i></a></td>

								<?php $totaloneprod = $items['price'] * $items['qty'] ?>
								<?php $total += $totaloneprod ?>
								<?php $totaloneprod = 0; ?>
							</tr>

							<tr>
								<td colspan="5" style="border-top: none !important; background-color: #fcfcfc !important;">
									<div class="panel-footer" style="border-top: none !important; padding: 0 !important">
										<div class="heading-elements">

											<?php 
											$kota_toko = "-";
											for ($i=0; $i < count($rajaongkir_kota); $i++) { 
												if($rajaongkir_kota[$i]['city_id'] == $items['asal']){
													$kota_toko = $rajaongkir_kota[$i]['city_name'];
												}
											}
											?>

											<span class="heading-text text-semibold"><?= number_format($items['berat'], 0, ',', '.') ?>gr &emsp; | &emsp; Dikirim oleh: <?= $items['seller'] ?> &emsp; | &emsp; <i class="icon-location4"></i> <?= $kota_toko ?></span>
										</div>
									</div>
								</td>
							</tr>


							<?php $i++; ?>

						<?php endforeach; ?>
						<tr>
							<td></td>
							<td></td>
							<td class="text-center"><b>TOTAL HARGA</b></td>
							<td><b>Rp. <?= number_format($total, 0, ',', '.') ?></b></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="panel-footer">
			<div class="heading-elements">
				<a href="<?= base_url('shopping/order') ?>"  class="btn btn-primary heading-btn pull-right">Lanjut ke pemesanan <i class="icon-arrow-right14 position-right"></i></a>
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
