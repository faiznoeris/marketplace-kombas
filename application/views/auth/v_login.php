<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container bg-white" style="padding: 25px; margin-top: 35px;">

	<form class="form-signin" method="post" action="<?php echo base_url('Auth/login/');?>">
		<center><img src="<?= base_url('/assets/images/favicon.png') ?>" style="max-height: 100px; max-width: 1000px;"></center><br><br>
		<label for="username" class="sr-only">Email address</label>
		<input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
		<label for="password" class="sr-only">Password</label>
		<input type="password" id="password" class="form-control" placeholder="Password" name="password" required>

		<label class="left">
			<b style="color: red; font-weight: 600; font-size: 13px;"><?php if(isset($error)){echo $error;} ?></b>
		</label>

<!-- 		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div> -->
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<a href="<?php echo base_url('register');?>" style="font-size: 14px;">Click here to register.</a>
	</form>

</div> 
