<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add New Product</span></h4>
			</div>


		</div>

		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<li><a href="<?= base_url('dashboard') ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li><a href="<?= base_url('dashboard/products') ?>">Products List</a></li>
				<li class="active">Add Product</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<!-- Form horizontal -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Menambahkan Product Baru</h5>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url('Seller/addproduct/'.$session["id_shop"]);?>" enctype='multipart/form-data'>
					<fieldset class="content-group">
						<legend class="text-bold">Data Product</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Nama Product</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Masukkan nama product" name="nama_product">
							</div>
						</div>

						<div class="form-group">
							<!-- <label class="control-label col-lg-2">Deskripsi Product</label>
							<div class="col-lg-10">
								<textarea rows="5" cols="5" class="form-control" placeholder="Masukkan deskripsi product" name="deskripsi_product"></textarea>
							</div> -->
							<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" placeholder="Enter text ..." name="deskripsi_product">
								<!-- <h1>WYSIHTML5 - A better approach to rich text editing</h1>
								<p>wysihtml5 is an <span class="wysiwyg-color-green"><a rel="nofollow" target="_blank" href="https://github.com/xing/wysihtml5">open source</a></span> rich text editor based on HTML5 technology and the progressive-enhancement approach.
								It uses a sophisticated security concept and aims to generate fully valid HTML5 markup by preventing unmaintainable tag soups and inline styles.</p>

								<h2>Features</h2>

								<ul>
									<li>It's fast and lightweight (smaller than TinyMCE, Aloha, ...)</li>
									<li>Auto-linking of urls as-you-type</li>
									<li>Generates valid and semantic HTML5 markup (even when the content is pasted from MS Word)</li>
									<li>Uses class names instead of inline styles</li>
									<li>Unifies line break handling across browsers</li>
									<li>Uses sandboxed iframes in order to prevent identity theft through XSS</li>
									<li>Speech-input for Chrome</li>
								</ul>

								<h2>Browser Support</h2>

								<ul>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_firefox.png" height="24"> Firefox 3.5+</li>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_chrome.png" height="24"> Chrome</li>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_internet_explorer.png" height="24"> IE 8+</li>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_safari.png" height="24"> Safari 4+</li>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_ios.png" height="24"> Safari on iOS 5+</li>
									<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_opera.png" height="24"> Opera 11+</li>
									<li><strong>Graceful degradation:</strong> Unsupported browsers will get a textarea</li>
								</ul> -->
							</textarea>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Kode Product (SKU)</label>
							<div class="col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan kode product" name="kode_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Harga Product</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan harga product" name="harga_product">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-2">Diskon Reseller</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan diskon reseller" name="discount_reseller">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Diskon Promo</label>
							<div class="col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan diskon promo" name="discount_promo">
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-lg-2">Promo Aktif</label>
							<div class="col-lg-10">
								<div class="checkbox checkbox-switchery">
									<label>
									<!-- 	<?php if($data_shop->toko_buka == "1"): ?>
											<input type="checkbox" class="switchery" checked="checked" name="toko_buka">
										<?php else: ?>
											<input type="checkbox" class="switchery" name="toko_buka">
										<?php endif ?> -->
										<input type="checkbox" class="switchery" name="promo_aktif">
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
								<input class="form-control" type="number" placeholder="Masukkan berat product" name="berat_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Gambar Sampul</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="sampul_product">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Category</label>
							<div class="col-lg-10">
								<select name="category" class="form-control">
									<?php foreach ($data_cat as $row): ?>
										<option value="<?= $row->id_category ?>"><?= $row->nama_category ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<legend class="text-bold">Galeri Foto Product</legend>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri 1</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_1">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri 2</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_2">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri 3</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_3">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri 4</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_4">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Galeri 5</label>
							<div class="col-lg-10">
								<input type="file" accept=".gif,.jpg,.png,.jpeg" class="file-styled" name="galeri_5">
							</div>
						</div>

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
							<button type="submit" class="btn btn-primary" id="btnsubmit">Tambahhkan <i class="icon-arrow-right14 position-right"></i></button>
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