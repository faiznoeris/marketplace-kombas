
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

	<!-- Content area -->
	<div class="content">

		<div class="panel panel-flat">
			<br><center><h3><b>WELCOME <?= $session['username'] ?></b></h3></center><br>

		</div>

		<?php if($user_lvl_name == "User"): ?>

			<!-- Basic datatable -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><b>Cancelled Order</b></h5>
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
							<th>#</th>
							<th>Id Transaksi</th>
							<th>Nama Barang</th>
							<th>Total Transfer</th>
							<th>Date Cancelled</th>
							<th>Last Status</th>
							<th>Refund Status</th>

						</tr>
					</thead>
					<tbody>
						<?php $counter = 1; ?>
						<?php foreach ($cancelled_order as $row): ?>


							<?php

							$dontcount = false;

							$prods = explode(',', $row->id_product); 

								//removing whitespace and counting how many product ordered in the shop
							$index = array_search('', $prods); 
							if ( $index !== false ) {
								unset( $prods[$index] );
							}

							$prod_detail = $this->m_products->getproduct($row->id_product)->row();
							$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();

							?>

							<?php if(count($prods) < 2): ?>

								<tr>
									<td><?= $counter ?></td>
									<td><?= $row->id_transaction ?></td>
									<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
									<td>Rp. <?= number_format($row->total, 0, ',', '.') ?></td>
									<td><?= $row->date ?></td>
									<td><?= $row->last_status ?></td>
									<td><?= $row->refund ?></td>



								</tr>

							<?php else: ?>

								<?php $first = true; ?>

								<?php foreach($prods as $p): ?>

									<?php 

									$prod_detail = $this->m_products->getproduct($p)->row(); 
									$history_product = $this->m_transaction_history_product->select2('transaction','product',$row->id_transaction,$prod_detail->id_product)->row();

									?>

									<?php if($first): ?>

										<tr>
											<td><?= $counter ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->id_transaction ?></td>
											<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
											<td rowspan="<?= count($prods) ?>">Rp. <?= number_format($row->total, 0, ',', '.') ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->date ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->last_status ?></td>
											<td rowspan="<?= count($prods) ?>"><?= $row->refund ?></td>


										</tr>

										<?php $first = false; ?>

									<?php else: ?>

										<tr>
											<td><?= $counter ?></td>
											<td><img src="<?= base_url($prod_detail->sampul_path) ?>" width="150" height="150">&emsp;&emsp;<?= $prod_detail->nama_product ?></td>
											<td style="display: none;"></td>
											<td style="display: none;"></td>
											<td style="display: none;"></td>
											<td style="display: none;"></td>
											<td style="display: none;"></td>
										</tr>

									<?php endif; ?>

									<?php $counter++; $dontcount = true; ?>

								<?php endforeach; ?>

							<?php endif; ?>

							<?php if(!$dontcount){$counter++;}  ?>

						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
			<!-- /basic datatable -->

		<?php elseif($user_lvl_name == "Seller"): ?>

			<!-- Invoices -->
			<center><h3>WARNING: BARANG BELUM DIKIRIM</h3></center>

			<div class="timeline-row">

				<div class="row">

					<?php foreach($data_exceed as $row): ?>

						<?php if($row->warning == '1'): ?>

							<?php
							$prods = explode(',', $row->id_product); 

							//removing whitespace and counting how many product ordered in the shop
							$index = array_search('', $prods); 
							if ( $index !== false ) {
								unset( $prods[$index] );
							}
							?>

							<div id="modal_brgdikirim_<?= $row->id_transaction ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Konfirmasi Barang Dikirim</h5>
										</div>

										<form method="post" action="<?php echo base_url('Seller/barangdikirim/'.$row->id_transaction.'/'.count($prods));?>">

											<div class="modal-body">
												<!-- <h6 class="text-semibold">Text in a modal</h6> -->

												<p>Apakah anda ingin mengkonfirmasi bahwa barang telah dikirim? <br>Jika iya silahkan isi kolom resi dibawah kemudian tekan confirm untuk konfirmasi barang telah dikirim ke pembeli.</p>
												<br>

												<div class="form-group">
													<label class="control-label col-lg-2">Resi</label>
													<div class="col-lg-7">
														<input type="text" class="form-control" name="resi">
													</div>
												</div>


												<br>

											</div>

											<div class="modal-footer">

												<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Confirm</button>

											</div>

										</form>

									</div>
								</div>
							</div>



							<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

							<?php

										//RAJA ONGKIR API GET PROVINSI

							$curl = curl_init();	
							curl_setopt_array($curl, array(
								CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_HTTPHEADER => array(
									"key: e5629870cbd922e9156805e0ffe6625c"
								),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							$data = json_decode($response, true);

							?>



							<div id="modal_alamat_<?= $row->id_transaction ?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Alamat Pengiriman</h5>
										</div>


										<div class="modal-body">
											<!-- <h6 class="text-semibold">Text in a modal</h6> -->

											<?php $alamat = $this->m_address->select('address',$row->id_address)->row(); ?>

											<h4 class="card-title"><?= $alamat->namaalamat ?></h4>
											<h6 class="card-subtitle mb-2 text-muted">a.n <?= $alamat->atasnama ?></h6>
											<p class="card-text"><b>Alamat:</b><br><?= $alamat->alamat ?>
												<br>
												<i><?= $alamat->kodepos ?></i><br>

												<?php
												for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
													if($data['rajaongkir']['results'][$i]['province_id'] == $alamat->provinsi){
														echo "<i>".$data['rajaongkir']['results'][$i]['province']."</i>";
													}

												}
												?>	
												<br>

												<?php

															//RAJA ONGKIR API GET KABUPATEN

												$curl = curl_init();	
												curl_setopt_array($curl, array(
													CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$alamat->provinsi,
													CURLOPT_RETURNTRANSFER => true,
													CURLOPT_ENCODING => "",
													CURLOPT_MAXREDIRS => 10,
													CURLOPT_TIMEOUT => 30,
													CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
													CURLOPT_CUSTOMREQUEST => "GET",
													CURLOPT_HTTPHEADER => array(
														"key: e5629870cbd922e9156805e0ffe6625c"
													),
												));

												$response = curl_exec($curl);
												$err = curl_error($curl);

												curl_close($curl);

												$data = json_decode($response, true);
												?> 

												<?php
												for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
													if($data['rajaongkir']['results'][$i]['city_id'] == $alamat->kabupaten){
														echo "<i>".$data['rajaongkir']['results'][$i]['city_name']."</i>";
													}

												}
												?>

												<br><br>
												<b>Telephone: </b> <?= $alamat->telephone ?>
											</p>
											<br>

										</div>

										<div class="modal-footer">

											<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

										</div>


									</div>
								</div>
							</div>



							<?php $buyer_detail = $this->m_users->select($row->id_user)->row(); ?>

							<div class="col-lg-6">
								<div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-6">
												<h6 class="text-semibold no-margin-top"><?= $buyer_detail->first_name.' '.$buyer_detail->last_name ?></h6>
												<ul class="list list-unstyled">
													<li>Invoice #: &nbsp;<?= $row->id_transaction ?></li>
													<li>Ordered on: <span class="text-semibold"><?= $row->date_ordered ?></span></li>
												</ul>
											</div>

											<div class="col-sm-6">
												<h6 class="text-semibold text-right no-margin-top">Rp. <?= number_format($row->totalharga + $row->totalongkir, 0, ',', '.') ?></h6>
												<ul class="list list-unstyled text-right">
													<li>Kurir & Paket: <span class="text-semibold"><?= strtoupper($row->kurir) ?>&nbsp; | &nbsp;<?= $row->jenis_paket ?></span></li>
													<li class="dropdown">
														Status: &nbsp;
														<span class="label bg-danger-400">Overdue</span>
													</li>
												</ul>
											</div>
										</div>
									</div>

									<div class="panel-footer panel-footer-condensed">
										<div class="heading-elements">
											<!-- <span class="heading-text">
												<span class="status-mark border-danger position-left"></span> Due: <span class="text-semibold">2015/02/25</span>
											</span> -->

											<ul class="list-inline list-inline-condensed heading-text pull-right">
												<!-- <li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i class="icon-eye8"></i></a></li> -->
												<li class="dropdown">
													<a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a data-toggle="modal" data-target="#modal_brgdikirim_<?= $row->id_transaction ?>") ?> Barang Dikirim</a></li>
														<li><a data-toggle="modal" data-target="#modal_alamat_<?= $row->id_transaction ?>"> Alamat Pengiriman</a></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>



						<?php endif; ?>

					<?php endforeach; ?>
					
				</div>
			</div>
			<!-- /invoices -->

		<?php else: ?>

		<?php endif; ?>

		

	</div>
	<!-- /dashboard content -->


	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
	</div>
	<!-- /footer -->

</div>
<!-- /content area -->

</div>
<!-- /main content