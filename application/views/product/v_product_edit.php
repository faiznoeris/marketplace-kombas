<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Mengubah Data Product</h5>
		</div>

		<div class="panel-body">
			<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/editproduct/'.$data_product->id_product);?>" enctype='multipart/form-data'>
				<fieldset class="content-group">
					<legend class="text-bold">Data Product</legend>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama Product</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?= $data_product->nama_product ?>" name="nama_product">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Deskripsi Product</label>
						<div class="col-lg-10">
							<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" name="deskripsi_product">

								<?= $data_product->deskripsi_product ?>

							</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Kode Product (SKU)</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="<?= $data_product->sku ?>" name="kode_product">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Stok Product</label>
						<div class="col-md-10">
							<input class="form-control" type="text" placeholder="Masukkan jumlah total stok product tersedia" name="stok_product">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Harga Product</label>
						<div class="col-md-10">
							<input class="form-control" type="number" value="<?= $data_product->harga ?>" name="harga_product">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-2">Diskon Reseller (%)</label>
						<div class="col-md-10">
							<input class="form-control" type="number" value="<?= $data_product->discount_reseller ?>" name="discount_reseller">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-2">Diskon Promo (%)</label>
						<div class="col-md-10">
							<input class="form-control" type="number" value="<?= $data_product->discount_promo ?>" name="discount_promo">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-2">Promo Aktif (ON/OFF)</label>
						<div class="col-lg-10">
							<div class="checkbox checkbox-switchery">
								<label>
									<?php if($data_product->promo_aktif == "1"): ?>
										<input type="checkbox" class="switchery" checked="checked" name="promo_aktif">
									<?php else: ?>
										<input type="checkbox" class="switchery" name="promo_aktif">
									<?php endif ?>
								</label>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-2">Berat Product (gram)</label>
						<div class="col-md-10">
							<input class="form-control" type="number" value="<?= $data_product->berat ?>" name="berat_product">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Product Category</label>
						<div class="col-lg-10">
							<select name="category" class="form-control">
								<?php foreach ($data_cat as $row): ?>
									<?php if($data_product->id_category == $row->id_category): ?>
										<option value="<?= $row->id_category ?>" selected><?= $row->nama_category ?></option>
									<?php else: ?>
										<option value="<?= $row->id_category ?>"><?= $row->nama_category ?></option>
									<?php endif; ?>

								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<?php 
					$galeries = explode(',',$data_product->galeri_path);
					?>

					<div class="form-group">
						<label class="control-label col-md-2">Galeri Product <span style="color: red">(gambar pertama akan dijadikan sampul)</span></label>
						<div class="col-lg-3 col-md-6">
							<div class="thumbnail">
								<div class="thumb">
									<img src="<?= base_url($data_product->sampul_path) ?>" alt="" style="height: 350px !important;">
									
								</div>

								<div class="caption text-center">
									<input type="file" class="file-styled" name="sampul">
								</div>

							</div>
						</div>

						<?php if(!empty($galeries[0])): ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url($galeries[0]) ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled" name="galeri_1" id="uplpict_1">
										<ul class="icons-list">
											<li>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" id="cbdelpict_1" name="cbdelpict_1">
														Hapus Gambar
													</label>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>


						<?php else: ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled" name="galeri_1" id="uplpict_1">
										
									</div>
								</div>
							</div>

						<?php endif; ?>




						<?php if(!empty($galeries[1])): ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url($galeries[1]) ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_2" id="uplpict_2">
										<ul class="icons-list">
											<li>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" id="cbdelpict_2" name="cbdelpict_2">
														Hapus Gambar
													</label>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>

						<?php else: ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="" style="height: 350px !important;"> 
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_2" id="uplpict_2">

									</div>

								</div>
							</div>

						<?php endif; ?>

					</div>

					<div class="form-group">
						<label class="control-label col-md-2"></label>

						<?php if(!empty($galeries[2])): ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url($galeries[2]) ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_3" id="uplpict_3">
										<ul class="icons-list">
											<li>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" id="cbdelpict_3" name="cbdelpict_3">
														Hapus Gambar
													</label>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>

						<?php else: ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_3" id="uplpict_3">
										
									</div>

								</div>
							</div>

						<?php endif; ?>

						<?php if(!empty($galeries[3])): ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url($galeries[3]) ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_4" id="uplpict_4">
										<ul class="icons-list">
											<li>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" id="cbdelpict_4" name="cbdelpict_4">
														Hapus Gambar
													</label>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>

						<?php else: ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_4" id="uplpict_4">
										
									</div>

								</div>
							</div>

						<?php endif; ?>

						<?php if(!empty($galeries[4])): ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail ">
									<div class="thumb">
										<img src="<?= base_url($galeries[4]) ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled"  name="galeri_5" id="uplpict_5">
										<ul class="icons-list">
											<li>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="styled" id="cbdelpict_5" name="cbdelpict_5">
														Hapus Gambar
													</label>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>

						<?php else: ?>

							<div class="col-lg-3 col-md-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="" style="height: 350px !important;">
										
									</div>

									<div class="caption text-center">
										<input type="file" class="file-styled" name="galeri_5">
										
									</div>

								</div>
							</div>

						<?php endif; ?>

					</div>





					<label class="left">
						<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
					</label>

					<label class="left">
						<b style="color: green; font-weight: 600; font-size: 13px;"><?php if(isset($info)){echo $info;} ?></b>
					</label>

					<div class="text-right">
						<button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
					</div>
				</form>
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
