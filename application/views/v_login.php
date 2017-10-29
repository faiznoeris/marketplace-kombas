<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container bg-white" style="padding: 25px; margin-top: 35px;">

	<form class="form-signin">
		<center><img src="<?= base_url('/assets/images/favicon.png') ?>" style="max-height: 100px; max-width: 1000px;"></center><br><br>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<a href="#" style="font-size: 14px;">Click here to register.</a>
	</form>

</div> 
