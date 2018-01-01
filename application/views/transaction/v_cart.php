<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">




	<h2>My Cart</h2><br>

	<table class="table table-responsive">
		<thead class="thead-default">
			<tr>
				<th width="5%">#</th>
				<th width="15%">Kode Barang</th>
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
			?>

			<?php foreach ($this->cart->contents() as $items): ?>

				<tr>
					<th scope="row"><?= $i; ?></th>
					<th><?= $items['id'] ?></th>
					<td><img src="https://id-live-03.slatic.net/p/7/distro-bandung-vr-355-sepatu-kets-sneakers-dan-kasual-pria-hitam-1487054474-20960041-d5ab29e5322276e9da877a49cd42cc3c.jpg" width="130" height="130"></td>
					<td><?= $items['name'] ?></td>
					<td>	
						<div class="quantity" id="Hidden<?= $items['id'] ?>">
							<input type="number" id="qty<?= $items['id'] ?>" min="1" max="100" step="1" value="<?= $items['qty'] ?>" disabled>
							<input type="hidden" id="rowid<?= $items['id'] ?>" value="<?= $items['rowid'] ?>">
						</div>

					</td>
					<td>Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
					<td><a href="<?= base_url('shopping/removecartitem/'.$items['rowid']) ?>" class="btn btn-danger btn-sm"><span class="oi oi-delete"></span></a></td>
					
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

	<br>

	<a href="<?= base_url('checkout') ?>" class="btn btn-primary float-right">Proceed to Checkout <span class="oi oi-external-link"></span></a>

	<br><br><br>


</div> <!-- /container -->

