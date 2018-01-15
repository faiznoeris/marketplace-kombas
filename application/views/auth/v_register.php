<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center col-12">
		<form method="post" action="<?php echo base_url('Auth/register/');?>" id="needs-validation" novalidate>
			<center><h3 class="title-median" style="color: black !important; font-size: 25px; font-weight: 600;">Registration Form</h3><span>Fill in the form below to get instant access.</span></center>

			<br><br>
			
			<div class="form-group row">
				<label for="validationCustom01" class="col-3 col-form-label">First Name</label>
				<div class="col-3">
					<input class="form-control" type="text" id="validationCustom01" placeholder="Mark" name="first_name" required>
				</div>
				<label for="validationCustom02" class="col-3 col-form-label">Last Name</label>
				<div class="col-3">
					<input class="form-control" type="text" id="validationCustom02" placeholder="Otto" name="last_name" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="validationCustom03" class="col-3 col-form-label">Username</label>
				<div class="col-9">
					<input class="form-control" type="text" placeholder="username32" id="validationCustom03" name="username" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="validationCustom04" class="col-3 col-form-label">Email</label>
				<div class="col-9">
					<input class="form-control" type="email" placeholder="bootstrap@example.com" id="validationCustom04" name="email" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="validationCustom05" class="col-3 col-form-label">Telephone</label>
				<div class="col-9">
					<input class="form-control" type="tel" placeholder="1-(555)-555-5555" id="validationCustom05" name="telephone" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="validationCustom06" class="col-3 col-form-label">Password</label>
				<div class="input-group col-9">
					<input class="form-control pwd" type="password" placeholder="*******" id="validationCustom06" name="password" required>
					<span class="input-group-btn">
						<button class="btn btn-default reveal" type="button"><span class="oi oi-eye"></span></button>
					</span>          
				</div>
			</div>
			<div class="form-group row">
				<label for="validationCustom07" class="col-3 col-form-label">Confirm Password</label>
				<div class="input-group col-9">
					<input class="form-control pwd2" type="password" placeholder="*******" id="validationCustom07" name="confirm_password" required>
					<span class="input-group-btn">
						<button class="btn btn-default reveal2" type="button"><span class="oi oi-eye"></span></button>
					</span>          
				</div>
			</div>
<!-- 			<div class="form-group row">
				<div class="col-sm-3">Daftar sebagai Dropshipper?</div>
				<div class="col-sm-9">
					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" name="dropshipper"> Dropshipper
						</label>
					</div>
				</div>
			</div> -->



			<label class="left">
				<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
			</label>

			<br><br>
			<center>
				<button class="btn btn-lg btn-primary btn-block w-25" type="submit" id="btnsubmit">Sign Up</button>
			</center>
		</form>   
	</div>
</div>