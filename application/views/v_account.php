<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container h-100">
	<div class="row row-offcanvas row-offcanvas-left">

		<div class="col-4 col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar">
			<ul class="nav flex-column pl-1" id="sidebartab" role="tablist">
				<li class="nav-item active">
					<a class="nav-link" data-toggle="tab" href="#biodata" role="tab">Biodata Diri</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#alamat" role="tab">Alamat</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#pembelian" role="tab" onclick="$('#sidebar').tab('hide')">Pembelian</a>
				</li>
			</ul>
		</div>
		<!--/col-->

		<div class="tab-content col-8 col-md-9 col-lg-10 sidebar-offcanvas">
			<div class="tab-pane" id="alamat" role="tabpanel">
				
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1">ALAMAT</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="exampleSelect1">Example select</label>
						<select class="form-control" id="exampleSelect1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleSelect2">Example multiple select</label>
						<select multiple class="form-control" id="exampleSelect2">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleTextarea">Example textarea</label>
						<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleInputFile">File input</label>
						<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
					</div>
					<fieldset class="form-group">
						<legend>Radio buttons</legend>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
								Option one is this and that&mdash;be sure to include why it's great
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
								Option two can be something else and selecting it will deselect option one
							</label>
						</div>
						<div class="form-check disabled">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
								Option three is disabled
							</label>
						</div>
					</fieldset>
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input">
							Check me out
						</label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

			</div>

			<div class="tab-pane" id="pembelian" role="tabpanel">

				<ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Status Pembayaran</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Status Pemesanan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Konfirmasi Penerimaan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Riwayat Transaksi</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active show" id="tabs-1" role="tabpanel">Tab 1 content</div>
					<div class="tab-pane" id="tabs-2" role="tabpanel">Tab 2 content</div>
					<div class="tab-pane" id="tabs-3" role="tabpanel">Tab 3 content</div>
					<div class="tab-pane" id="tabs-4" role="tabpanel">Tab 4 content</div>
				</div>

			</div>

			<div class="tab-pane active" id="biodata" role="tabpanel">

				
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="exampleSelect1">Example select</label>
						<select class="form-control" id="exampleSelect1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleSelect2">Example multiple select</label>
						<select multiple class="form-control" id="exampleSelect2">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleTextarea">Example textarea</label>
						<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleInputFile">File input</label>
						<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
						<small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
					</div>
					<fieldset class="form-group">
						<legend>Radio buttons</legend>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
								Option one is this and that&mdash;be sure to include why it's great
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
								Option two can be something else and selecting it will deselect option one
							</label>
						</div>
						<div class="form-check disabled">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
								Option three is disabled
							</label>
						</div>
					</fieldset>
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input">
							Check me out
						</label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>

	</div>


</div>