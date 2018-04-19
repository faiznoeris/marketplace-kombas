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
					<thead>
						<tr>
							<th width="5%">#</th>
							<!-- <th width="15%">Kode Barang</th> -->
							<th width="15%">Seller</th>
							<th width="20%">Gambar</th>
							<th width="32%">Nama Barang</th>
							<th width="15%">Jumlah</th>
							<th width="13%">Harga</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1; 
						$total = 0;
						$totaloneprod = 0;
						$cart = $this->cart->contents();

						function sortByName($a, $b)
						{
							$a = $a['seller'];
							$b = $b['seller'];

							if ($a == $b) return 0;
							return ($a < $b) ? -1 : 1;
						}

						usort($cart, 'sortByName');

						?>

						<?php foreach ($cart as $items): ?>

							<tr>
								<th scope="row"><?= $i; ?></th>
								<!-- <th><?= $items['id'] ?></th> -->
								<th><?= $items['seller'] ?></th>
								<td><img src="<?= base_url($items['sampul']) ?>" width="130" height="130"></td>
								<td><?= $items['name'] ?></td>
								<td>	
									<div class="quantity" id="Hidden<?= $items['id'] ?>">
										<input type="number" id="qty<?= $items['id'] ?>" min="1" max="100" step="1" value="<?= $items['qty'] ?>" disabled>
										<input type="hidden" id="rowid<?= $items['id'] ?>" value="<?= $items['rowid'] ?>">
										<input type="hidden" id="idprod<?= $items['id'] ?>" value="<?= $items['id_prod'] ?>">
									</div>

								</td>
								<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
								<td><a href="<?= base_url('shopping/removecartitem/'.$items['rowid']) ?>" class="btn bg-danger-400 btn-block"><i class="icon-cart-remove"></i></a></td>

								<?php $totaloneprod = $items['price'] * $items['qty'] ?>
								<?php $total += $totaloneprod ?>
								<?php $totaloneprod = 0; ?>

							</tr>


							<?php $i++; ?>

						<?php endforeach; ?>
						<tr>
							<th scope="row"></th>
							<td colspan="4" class="text-center"><b>TOTAL HARGA</b></td>
							<td colspan="5"><b>Rp. <?= number_format($total, 0, ',', '.') ?></b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<div class="heading-elements">
				<a href="<?= base_url('checkout') ?>"  class="btn btn-primary heading-btn pull-right">Proceed to Checkout <i class="icon-arrow-right14 position-right"></i></a>
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
