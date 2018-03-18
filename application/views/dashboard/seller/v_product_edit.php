<div id="jGrowl-product-<?= $session["id_user"] ?>" class="jGrowl top-right"></div>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Product</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li><a href="<?= base_url('dashboard/products') ?>">Products List</a></li>
				<li class="active">Edit Product</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
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
							<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" name="deskripsi_product">

								<?= $data_product->deskripsi_product ?>

							</textarea>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Kode Product (SKU)</label>
							<div class="col-md-10">
								<input class="form-control" type="text" value="<?= $data_product->sku ?>" name="kode_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Harga Product</label>
							<div class="col-md-10">
								<input class="form-control" type="number" value="<?= $data_product->harga ?>" name="harga_product">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-2">Diskon Reseller</label>
							<div class="col-md-10">
								<input class="form-control" type="number" value="<?= $data_product->discount_reseller ?>" name="discount_reseller">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-2">Diskon Promo</label>
							<div class="col-md-10">
								<input class="form-control" type="number" value="<?= $data_product->discount_promo ?>" name="discount_promo">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-lg-2">Promo Aktif</label>
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


						

						<!-- <div class="form-group">
							<label class="control-label col-md-2">Minimal Order</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan minimal order" name="minimal_order">
							</div>
						</div> -->

						<div class="form-group">
							<label class="control-label col-md-2">Berat Product (gram)</label>
							<div class="col-md-10">
								<input class="form-control" type="number" value="<?= $data_product->berat ?>" name="berat_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Gambar Sampul</label>
							<div class="col-md-10">

								<div class="thumbnail" style="width: 350px !important; height: 50%;">
									<div class="thumb">
										<img src="<?= base_url($data_product->sampul_path) ?>">
										<div class="caption-overflow">
											<span>
												<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="sampul_product">
											</span>
										</div>
									</div>
								</div>

							</div>
						</div>

						<!-- <div class="form-group">
							<label class="control-label col-lg-2">Gambar Sampul</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="sampul_product">
							</div>
						</div> -->

						<div class="form-group">
							<label class="control-label col-lg-2">Category</label>
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

						<legend class="text-bold">Galeri Foto Product</legend>


						<?php 
						$galeries = explode(',',$data_product->galeri_path);
						?>


						<?php if(!empty($galeries[0])): ?>
							<div class="form-group">
								<label class="control-label col-md-2">Galeri 1</label>
								<div class="col-md-10">

									<div class="thumbnail" style="width: 350px !important; height: 50%;">
										<div class="thumb">
											<img src="<?= base_url($galeries[0]) ?>">
											<div class="caption-overflow">
												<span>
													<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="galeri_1">
												</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php else: ?>

							<div class="form-group">
								<label class="control-label col-lg-2">Gambar Sampul</label>
								<div class="col-lg-10">
									<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_1">
								</div>
							</div>

						<?php endif; ?>






						<?php if(!empty($galeries[1])): ?>
							<div class="form-group">
								<label class="control-label col-md-2">Galeri 2</label>
								<div class="col-md-10">

									<div class="thumbnail" style="width: 350px !important; height: 50%;">
										<div class="thumb">
											<img src="<?= base_url($galeries[1]) ?>">
											<div class="caption-overflow">
												<span>
													<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="galeri_2">
												</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php else: ?>

							<div class="form-group">
								<label class="control-label col-lg-2">Galeri 2</label>
								<div class="col-lg-10">
									<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_2">
								</div>
							</div>

						<?php endif; ?>




						<?php if(!empty($galeries[2])): ?>
							<div class="form-group">
								<label class="control-label col-md-2">Galeri 3</label>
								<div class="col-md-10">

									<div class="thumbnail" style="width: 350px !important; height: 50%;">
										<div class="thumb">
											<img src="<?= base_url($galeries[2]) ?>">
											<div class="caption-overflow">
												<span>
													<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="galeri_3">
												</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php else: ?>

							<div class="form-group">
								<label class="control-label col-lg-2">Galeri 3</label>
								<div class="col-lg-10">
									<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_3">
								</div>
							</div>

						<?php endif; ?>






						<?php if(!empty($galeries[3])): ?>
							<div class="form-group">
								<label class="control-label col-md-2">Galeri 4</label>
								<div class="col-md-10">

									<div class="thumbnail" style="width: 350px !important; height: 50%;">
										<div class="thumb">
											<img src="<?= base_url($galeries[3]) ?>">
											<div class="caption-overflow">
												<span>
													<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="galeri_4">
												</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php else: ?>

							<div class="form-group">
								<label class="control-label col-lg-2">Galeri 4</label>
								<div class="col-lg-10">
									<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_4">
								</div>
							</div>

						<?php endif; ?>






						<?php if(!empty($galeries[4])): ?>
							<div class="form-group">
								<label class="control-label col-md-2">Galeri 5</label>
								<div class="col-md-10">

									<div class="thumbnail" style="width: 350px !important; height: 50%;">
										<div class="thumb">
											<img src="<?= base_url($galeries[4]) ?>">
											<div class="caption-overflow">
												<span>
													<input type="file" class="form-control" accept=".gif,.jpg,.png,.jpeg" name="galeri_5">
												</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php else: ?>

							<div class="form-group">
								<label class="control-label col-lg-2">Galeri 5</label>
								<div class="col-lg-10">
									<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_5">
								</div>
							</div>

						<?php endif; ?>


						

						



						

						<!-- <div class="form-group">
							<label>Tags</label>
							<input type="text" class="form-control tokenfield" value="">
						</div> -->

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
			<!-- /form horizontal -->


			<!-- Footer -->
			<div class="footer text-muted">
				&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
			</div>
			<!-- /footer -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content